<?php
    class Globals{
        public function redir($url){
            header("Location: {$url}");
        }
        public function uploadFile($file,$urlAdmin,$urlCus,$fileType,$file_size){
            $fileName   = $file['name'];
            $tmp        = $file['tmp_name'];
            $fsize      = $file['size'];
            $ext        = $this->getExtension($fileName);
            $ml         = time();
            $err_code = '';
            $fName_new = "{$ml}_{$fileName}";
            $url_server = "{$urlAdmin}/{$fName_new}";
            $url_server_copy = "{$urlCus}/{$fName_new}";
            if(!in_array($ext,$fileType)){
                $err_code = '101';
            }
            if($fsize>$file_size){
                $err_code='102';
            }

            if($err_code==''){
                if(move_uploaded_file($tmp,$url_server)){
                    $err_code = $url_server;
                    copy($url_server,$url_server_copy);
                }
            } 
            return $err_code;
        }
        public function getExtension($str){
            $astr = explode('.',$str);
            $ext    = (is_array($astr))?end($astr):'';
            return strtolower($ext);
        }
        public function pagination($url,$T,$L,$prev,$next){
            $p = 1;
            $pager = "<div class='page' id='btnPrev'><a href ='{$url}&page={$prev}'><<</a></div>";
            $total_Pi = ceil($T/$L);
            if($total_Pi < 5) $maxPage = $total_Pi;
            else $maxPage = 5;
            while($p<=$maxPage){
                $pager .= "<div class='page'><a href ='{$url}&page={$p}'page'>{$p}</a></div>";
                $p++;
            }
            $pager .= "<div class='page' id='btnNext'><a href ='{$url}&page={$next}'>Next</a></div>";
            return $pager;
        }
        
        public function better_pagination($url,$tblRows,$pageinonce,$currentPage,$prev,$next,$keyword){
            $totalPage = ceil($tblRows/$pageinonce);
            $pager = "<nav aria-label='Page navigation example' ><ul class='pagination'>";
            $pager .= "<li class='page-item'><a class='page-link' href ='{$url}&page={$prev}&keyword={$keyword}/'>&laquo;</a></li>";
            if($currentPage%5==0){
                $start = $currentPage;
                if($start+1>$totalPage) $end = $totalPage;
                else $end = $start+1;
                for($i=$start; $i<=$end; $i++){
                    if($i==$currentPage){
                        $pager .= "<li class='page-item active'><a class='page-link' href ='{$url}&page={$i}&keyword={$keyword}/'page'>{$i}</a></li>";
                    }
                    else {
                        $pager .= "<li class='page-item'><a class='page-link' href ='{$url}&page={$i}&keyword={$keyword}/'page'>{$i}</a></li>";
                    }
                }
            }
            else{
                $start=$currentPage - $currentPage%5 + 1;
                if($start+4>$totalPage) $end = $totalPage;
                else $end = $start+4;
                for($i=$start; $i<=$end; $i++){
                    if($i==$currentPage){
                        $pager .= "<li class='page-item active'><a class='page-link' href ='{$url}&page={$i}&keyword={$keyword}/'page'>{$i}</a></li>";
                    }
                    else{
                        $pager .= "<li class='page-item'><a class='page-link' href ='{$url}&page={$i}&keyword={$keyword}/'page'>{$i}</a></li>";
                    }
                }
            }
            $pager .= "<li class='page-item'><a class='page-link' href ='{$url}&page={$next}&keyword={$keyword}/'>&raquo;</a></li>";
            $pager .= "</ul></nav>";
            return $pager;

        }
        public function getRules($ruleList,$act){
            $rule = '';
            if(strlen($ruleList)>0){
                $arRule = explode('|',$ruleList);
                if(in_array($act,$arRule)){
                    $rule = $ruleList;
                }
            }
            return $rule;
        }
        public function sent_email($cus_email){

            }
        }