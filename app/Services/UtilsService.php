<?php 
namespace App\Services;
use Illuminate\Database\Eloquent\Model;


class UtilsService {

    //recherche pour tous les modèles
    public static function Search(Model $model) {
        $query = $model::query();
        foreach($model->getAttributes() as $attribute => $values) {
            if($values !== null) {
                if(is_numeric($values)) {
                    $query->where($attribute, '=', $values);
                }
                elseif(is_string($values)) {
                    $query->where($attribute, 'like', "%$values%");
                }
                else {
                    $query->where($attribute, '=', $values);
                }
            }
        }
        return $query;
    }

    //PAGINATION
    public static function getPagination($url,$count,$page,$select = 0,$limit = 6) {
        $html = "";
        $link = url($url);
        if($count > 0) {
            if($page == 1) $html .= "«";
            else $html .= "<a href='$link/".($page-1).($select > 0 ? "/".$select : "")."'>«</a>";
            $html .= " $page ";
            if($page > $count/$limit)  $html .= "»";
            else $html .= "<a href='$link/".($page+1).($select > 0 ? "/".$select : "")."'>»</a>";
        }
        return $html;
    }
}
?>