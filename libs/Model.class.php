<?php
    class Model{
        public $_db;
        public function __construct($usr,$pwd,$dbname){
            try{
                //data source name;
                $dsn = "mysql:dbname={$dbname};port=3306";
                $this->_db = new PDO($dsn,$usr,$pwd);
            }catch(PDOException $e){
                echo "Khong the ket noi database";
            }
        }
        public function executeSQL($sql){
            $stmt = $this->_db->prepare($sql);
            //PDOStatement
            $stmt->execute();
            return $stmt;//trong $stmt 
        }
        public function fetchAll($sql){
            $rs = $this->executeSQL($sql);
            return $rs->fetchAll(PDO::FETCH_ASSOC);//ham fetchAll() la thanh phan cua Statement
            //return mang 2 chieu
        }
        public function fetchOne($sql){
            $rs = $this->executeSQL($sql);
            return $rs->fetch(PDO::FETCH_ASSOC);
        }
        public function getSelectBox($sName,$arr,$fKey,$fValue,$mess){
            $slBox ="<select name='{$sName}' id='{$sName}'  class='custom-select'>
                    <option value='-1'>{$mess}</option>";
            foreach($arr as $row){
                $vKey   = $row[$fKey];
                $vValue = $row[$fValue]; 
                $slBox .= "<option value='{$vKey}'>{$vValue}</option>";  
            }
            $slBox .= '</select>'; 
            return $slBox;
        }
        public function getSB_value($sName,$arr,$fValue,$mess){
            $slBox ="<select name='{$sName}' id='{$sName}' >
                    <option value='-1' >{$mess}</option>";
            foreach($arr as $row){
                $vValue = $row[$fValue]; 
                $slBox .= "<option value='{$vValue}'>{$vValue}</option>";  
            }
            $slBox .= '</select>'; 
            return $slBox;
        }
        public function getSelectBox1($sName,$arr,$fKey,$fValue,$mess){
            $slbox ="<select name='{$sName}' id='{$sName}' class='custom-select'  onchange='giveSelection(this.value)'required>
                    <option value='' disabled selected>{$mess}</option>";
            foreach($arr as $row){
                $vKey = $row[$fKey];
                $vValue = $row[$fValue];
                $slbox .="<option value='{$vKey}'>{$vValue}</option>";
            }
            $slbox .= '</select>';
            return $slbox;
        }
        public function getSelectBox2($sName,$arr,$fKey,$fValue,$dValue,$mess){
            $slbox ="<select name='{$sName}'class='custom-select'  id='{$sName}' required>
                    <option></option>";
            foreach($arr as $row){
                $vKey = $row[$fKey];
                $vValue = $row[$fValue];
                $vdValue = $row[$dValue];
                $slbox .="<option value='{$vKey}' data-option='{$vdValue}'>{$vValue}</option>";
            }
            $slbox .= '</select>';
            return $slbox;
        }
        public function update($tbl,$arr,$where){
            $strSet = '';
            $ar = array();
            $flag = 'NO';
            foreach($arr as $tenTruong=>$dulieu){
                $x = "{$tenTruong}='{$dulieu}'";
                array_push($ar,$x);
            }
            $strSet = implode(',',$ar);
            if(strlen($strSet)>0){
                $sql = " UPDATE {$tbl} SET {$strSet} WHERE {$where}";
                if($this->executeSQL($sql)){
                    $flag = 'YES';
                }
            }
            return $flag;
        }        
        public function insert($tbl,$values){
            $sql="SELECT COLUMN_NAME
            FROM INFORMATION_SCHEMA.COLUMNS
            WHERE TABLE_NAME = '{$tbl}'";
            $arr = array();
            $tblcolumn = $this->fetchAll($sql);
            foreach($tblcolumn as $r){
                array_push($arr,$r['COLUMN_NAME']);
            }
            $strSet = '';
            unset($arr[0]);
            $strSet = implode(',',$arr);
            $sql1 = "INSERT INTO $tbl({$strSet}) VALUES('{$values}')";
            $stmt = $this->executeSQL($sql1);
            return $stmt;
        }
        public function insert1($tbl,$arr){
            $flag       ='NO';
            $sql        ='';
            $arField    =array();
            $arValue    =array();
            $strField   ='';
            $strValue   ='';
            if(is_array($arr)){
                $arField    =array_keys($arr);
                $arValue    =array_values($arr);
                $strField   =(is_array($arField))?implode(',',$arField):'';
                $strValue   =(is_array($arValue)&&count($arValue)>0)?implode(',',$arValue):'';
                if(strlen($strField)>0&&strlen($strValue)>0){
                    $sql = "INSERT INTO {$tbl}({$strField}) VALUES({$strValue})";
                    if($this->executeSQL($sql)){
                        $flag = 'YES';
                    }
                }
            }
            return $flag;
        }
        public function insertBetter($tbl, $arr){
            $flag = 'NO';
            $sql = '';
            $arField = array(); 
            $arValue = array(); 
            $strField = ''; 
            $strValue = ''; 
            if(is_array($arr)){
                $arField = array_keys($arr);
                $arValue = array_values($arr);
                $strField = (is_array($arField))?implode(',',$arField):'';
                $strValue = (is_array($arValue)&&count($arValue)>0)?implode(',',$arValue):'';
                if(strlen($strField)>0&&strlen($strValue)>0){
                    $sql = "INSERT INTO {$tbl}({$strField}) VALUES({$strValue})";
                    if($this->executeSQL($sql)){
                        $flag = 'YES';
                    }
                }
            }
            return $flag;
        }
        
        public function checkExisted($tbl,$name,$col){
            $flag = 'YES';
            $sql = "SELECT COUNT(*) FROM {$tbl} WHERE {$col}='{$name}'";
            $num = $this->fetchOne($sql);
            foreach($num as $r){
                $x=$r[0];
            }
            if($x>0) $flag='NO';
            return $flag;
        }
        public function checkPass($name,$pass){
            $flag = 'YES';
            $sql = "SELECT user_password FROM tblusers u WHERE u.user_name='{$name}'";
            $pw = $this->fetchOne($sql);
            foreach($pw as $r){
                $x=$r[0];
            }
            if($x != $pass){
                $flag = NO;
            }
            return $flag;
        }
        public function searchExisted($tbl1,$tbl2,$column_name,$column_brand,$column_id,$condition){
            $sql = "SELECT {$tbl1}.*,{$tbl2}.* FROM {$tbl1}
                    LEFT JOIN {$tbl2} ON  {$tbl2}.{$column_id}={$tbl1}.{$column_id}
                    WHERE {$condition}
                    ORDER BY {$column_brand} 
                    LIMIT 0,20";
            $tbl = $this->fetchAll($sql);
            return $tbl;
        }
        public function countAll($table){
            $sql = "SELECT * FROM $table";
            $stmt = $this->executeSQL($sql);
            return $stmt->rowCount();
        }
    }