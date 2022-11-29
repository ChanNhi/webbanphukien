<?php
    
    function similarity_distance($matrix,$person1,$person2){
        $similar = array();
        $sum = 0;


        foreach($matrix[$person1] as $key=>$value){
            
            if(array_key_exists($key,$matrix[$person2])){
                $similar[$key] = 1;
            }
        }
        if($similar==0){
            return 0;
        }
        foreach($matrix[$person1] as $key=>$value){
            //Kiểm tra key của mảng matrix[khách đăng nhập] có tồn tại trong mảng matrix[khách 2]
            if(array_key_exists($key,$matrix[$person2])){
                $sum=$sum+pow($value-$matrix[$person2][$key],2);
            }
        }
        return 1/(1+sqrt($sum));
    }

    function getRecommendation($matrix,$person){
        $total = array();
        $simsums = array();
        $ranks=array();

        foreach($matrix as $otherperson=>$value){
            //Nếu khách đăng nhập khác vs khách trong vòng lập
            if($otherperson!=$person){
                //Độ tương tự
                $sim = similarity_distance($matrix,$person,$otherperson);

                foreach($matrix[$otherperson] as $key=>$value){
                    //Nếu key trong mảng matrix[Khách vòng lặp] không nằm trong key của màng matrix[khách đang đăng nhập]
                    if(!array_key_exists($key, $matrix[$person])){

                        if(!array_key_exists($key,$total)){
                            $total[$key]=0;
                        }
                        $total[$key]+=$matrix[$otherperson][$key]*$sim;
                            
                        if(!array_key_exists($key,$simsums)){
                            $simsums[$key]=0;
                        }
                        $simsums[$key]+=$sim;
                    }
                }
            }
        }
        foreach($total as $key=>$value){
            $ranks[$key]=$value/$simsums[$key];
            
        }
        array_multisort($ranks, SORT_DESC);
        return $ranks;
    }