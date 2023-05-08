<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;



use App\Services\UtilsService;

use App\Models\Utilisateur;
use App\Models\Article;



class UtilisateurController extends Controller
{
    //
    public function Signin(Request $request) {
        $user = Utilisateur::where('email',$request->input('email'))->where('password',md5($request->input('password')));
        if($user->exists()) {
            session()->put('user',$user->first()->id);
            return redirect()->route('Home');
        }
        else return redirect()->back()->with('Error','Email ou mot de passe incorrect!');
    }

    public function Logout() {
        app('session')->forget('user');
        return view('index');
    }

    public function Signup(Request $request) {
        $data = $request->all();
        if($data['password'] == $data['password_repeat']) {
            $data = array_replace($data,['password' => md5($data['password'])]);
            unset($data['password_repeat']);
            $user = Utilisateur::create($data);
            return redirect()->back()->with('success','Inscription faite!');
        }
        else redirect()->back()->with('Error','Mots de passe différents!');
    }

    public function ForgetPassword(Request $request) {
        $data = $request->all();
        if($data['password'] == $data['password_repeat']) {
            $user = Utilisateur::where('email',$data['email'])->first();
            $user->password = md5($data['password']);
            $user->save();
            return redirect()->back()->with('success','Votre mot de passe a été modifié!');
        }
        else return redirect()->back()->with('Error','Mots de passe différents!');
    }

    public function toHome($limit = 6) {
        $list = Article::join('publication', 'article.id', '=', 'publication.idarticle')
               ->where('publication.etat', '=', 1)
               ->orderBy('publication.publish_at', 'desc')
               ->simplePaginate($limit);
        return view('Home',[
            'liste_article' => $list,
            'links' => $list->links()
        ]);
    }

    public function toSearch() {
        return view('Search',[
            "liste_article" => "",
            "links" => ""
        ]);
    }

    public function Search(Request $request) {
        $query = Article::select('*')
        ->join('publication', 'article.id', '=', 'publication.idarticle');
        if ($request->filled('categorie')) {
            $query->where('categorie', 'like', '%' . $request->input('categorie') . '%');
        }

        if ($request->filled('texte')) {
            $query->where(function($q) use ($request) {
                $q->where('titre', 'like', '%' . $request->input('texte') . '%')
                ->orWhere('resume', 'like', '%' . $request->input('texte') . '%')
                ->orWhere('contenu', 'like', '%' . $request->input('texte') . '%');
            });
        }

        if ($request->filled('publish_at_1')) {
            $query->where('publication.publish_at', '>=', $request->input('publish_at_1'));
        }

        if ($request->filled('publish_at_2')) {
            $query->where('publication.publish_at', '<=', $request->input('publish_at_2'));
        }
        $articles = $query->simplePaginate(6);
        return view('Search',[
            'liste_article' => $articles,
            'links' => $articles->links()
        ]);
    }

    public function getDetails($slug) {
        $file_without_extension = basename($slug, ".html"); // renvoie "un-titre-très-long_unid"
        $idarticle = substr(strrchr($file_without_extension, "_"), 1);
        $article =  Article::find(intval($idarticle));
        if($article!==null) {
            return view('Details',['article' => $article]);
        }
        else abort(404);

    }
}
