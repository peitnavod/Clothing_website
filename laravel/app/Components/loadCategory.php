<?php
namespace App\Components;
class loadCategory{
    private  $htmlSelect = '';
    private $data;
    public function  __construct($data)
    {
       $this->data = $data;
    }
    public  function load($parentID,$id=0,$test='')
    {
        foreach ($this->data as $value)
        {
            if($value['parent_id'] == $id)
            {
                if($parentID==$value['id'])
                {
                    $this->htmlSelect .= "<option selected value='".$value['id']."' >" .$value['name'] .  "</option>";
                }
                else
                {
                    $this->htmlSelect .= "<option  value='".$value['id']."'>" . $test. $value['name'] . "</option>";
                }
                $this->load($parentID,$value['id'],$test='--');
            }
        }
        return $this->htmlSelect;
    }
}
