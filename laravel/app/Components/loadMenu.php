<?php
namespace App\Components;
use App\Models\Menu;

class loadMenu{
    private $data;
    private $htmlSelect ='';
    public function __construct()
    {
       $this->htmlSelect = '';
    }

    public function load($parent_id = 0){
        $data   = Menu::where('parent_id',$parent_id)->get();
        foreach ($data as $item)
        {
            $this->htmlSelect .= '<option value="'.$item->id.'">' . $item->name .'</option>';
            $this->load($item->id);
        }
        return $this->htmlSelect;
    }
    public function loadMenuEdit($id,$parent_id = 0){
        $data   = Menu::where('parent_id',$parent_id)->get();
        foreach ($data as $item)
        {
            if($id == $item['id'])
            {
                $this->htmlSelect .= '<option selected value="'.$item->id.'">' . $item->name .'</option>';
            }
            else
            {
                $this->htmlSelect .= '<option value="'.$item->id.'">' . $item->name .'</option>';
            }
           $this->loadMenuEdit($id,$item->id);
        }
        return $this->htmlSelect;
    }
}
