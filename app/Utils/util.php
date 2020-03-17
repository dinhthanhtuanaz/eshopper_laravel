<?php
    if(!function_exists('getIdFromLink')){
        function getIdFromLink($slug){
            $infoArr = explode('.', $slug);
            $firstSlug = $infoArr[count($infoArr)-2];
            $infoArr = explode('-', $firstSlug);
            $id = $infoArr[count($infoArr)-1];
            return $id;
        }
    }
    if(!function_exists('money_format')){
        function money_format($price){

            return number_format($price) . " đ";
        }
    }
    function spDemoTag($class="hihi", $text){
        return "<h1 class='$class'>$text</h1>";
    }
    function spSelectTwoStateTag($class,$id, $name, $sessionArrName,
                                $textIsTrue, $textIsFalse, $trueOnFirst=true, $currentItem=null,
                                $key="status"){
        $html = "<select class='$class' id='$id' name='$name'>";
        if(session()->has($sessionArrName)){
            if(session()->get($sessionArrName)[$name]==1){
                $html .= "<option value='1' selected>$textIsTrue</option>";
                $html .= "<option value='0'>$textIsFalse</option>";
            } else{
                $html .= "<option value='1'>$textIsTrue</option>";
                $html .= "<option value='0' selected>$textIsFalse</option>";
            }
        }else{
            //CASE ADD
            if(is_null($currentItem)){
                if($trueOnFirst){
                    $html .= "<option value='1'>$textIsTrue</option>";
                    $html .= "<option value='0'>$textIsFalse</option>";
                } else{
                    $html .= "<option value='0'>$textIsFalse</option>";
                    $html .= "<option value='1'>$textIsTrue</option>";
                }
            }
            //CASE EDIT
            else{
                if($key == "status"){
                    $html .= "<option value='1'";
                    if($currentItem->status==1) $html .= 'selected';
                    $html .= ">$textIsTrue</option>";
                    $html .= "<option value='0'";
                    if($currentItem->status==0) $html .= 'selected';
                    $html .= ">$textIsFalse</option>";
                } else if($key == "hot"){
                    $html .= "<option value='1'";
                    if($currentItem->hot==1) $html .= 'selected';
                    $html .= ">$textIsTrue</option>";
                    $html .= "<option value='0'";
                    if($currentItem->hot==0) $html .= 'selected';
                    $html .= ">$textIsFalse</option>";
                }

            }

        }
        $html .= "</select>";
        return $html;
    }

    function spSelectTag($class, $id, $name, $sessionArrName, $inputArr, $idItemInArr=null){
        //$sessionArrName là 1 mảng lưu dữ liệu vừa nhập, lưu bằng session flash
        //từng item của mảng chính là giá trị trong input, select, or textarea
        //ở đây select thì giá trị là ID
        //session()->get($sessionArrName)[$name] : là lấy ra ID đó, cái này là Session Flash
        $html = "<select class='$class' id='$id' name='$name'>";
        if(session()->get($sessionArrName)[$name]){
            foreach($inputArr as $item){
                if($item->id == session()->get($sessionArrName)[$name]){
                    $html .= "<option value='$item->id' selected>$item->name</option>";
                } else{
                    $html .= "<option value='$item->id'>$item->name</option>";
                }
            }
        } else{
            //Case ADD thì $currentItem chưa có
            if(is_null($idItemInArr)){
                foreach($inputArr as $item){
                    $html .= "<option value='$item->id'>$item->name</option>";
                }
            }else{
                //Case EDIT
                foreach($inputArr as $item){
                    $html .= "<option value='$item->id'";
                    if($item->id == $idItemInArr){
                        $html .= 'selected';
                    }
                    $html .= ">$item->name</option>";
                }
            }

        }
        $html .= "</select>";
        return $html;
    }

    function printOrderStatus($status){
        switch($status){
            case 0:
                $textStatus = "Đang chờ";
            break;
            case 1:
                $textStatus = "Đang giao";
            break;
            case 2:
                $textStatus = "Đã nhận";
            break;
            default:
        break;
        }
        return $textStatus;
    }
?>
