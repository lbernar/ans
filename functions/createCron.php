<?php
/*
* Code to crontab entry
*/

class CreateCron {
 
    function createCronModel($sinalID,$pass,$db) {
        $sinalDetail = $this->getSinalDetail($sinalID, $db);
        $dateTime = $this->getDateTime($sinalDetail['data_sinal']);
        $day = $dateTime[0];
        $month = $dateTime[1];
        $year = $dateTime[2];
        $hour = $dateTime[3];
        $min = $dateTime[4];
        if($min == 00 && $hour == 00 && $day == 01) {
            if($month == 01) {
                $month = 12;
                $year = $year - 1;
            } 
            else {
                $month = $month - 1;
            }
            $day = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $hour = 23;
            $min = 59;
        }
        elseif($min == 00 && $hour == 00) {
            $day = $day - 1;
            $hour = 23;
            $min = 59;
        }
        elseif($min == 00) {
            $hour = $hour - 1;
            $min = 59;
        }
        else {
            $min = $min - 1;
        }  
        $cronEntry = "$min $hour $day $month * php $_SERVER[DOCUMENT_ROOT]/functions/callIQBuy.php $sinalID $pass >> $_SERVER[DOCUMENT_ROOT]/functions/cron.log";
        file_put_contents("$_SERVER[DOCUMENT_ROOT]/functions/crontab.txt", $cronEntry.PHP_EOL, FILE_APPEND);
    }

    public function insertToCron() {
        $output = $this->getCron();
        file_put_contents("$_SERVER[DOCUMENT_ROOT]/functions/crontab.txt", $output.PHP_EOL, FILE_APPEND);
        exec("crontab $_SERVER[DOCUMENT_ROOT]/functions/crontab.txt");
        unlink("$_SERVER[DOCUMENT_ROOT]/functions/crontab.txt");
    }

    public function getCron() {
        return shell_exec('crontab -l');
    }

    public function deleteCron() {
        exec("crontab -r");
    }

    private function getSinalDetail($sinalID, $db) {
        include_once "db-connect.php";
        $query = $db->prepare("SELECT data_sinal FROM sinal WHERE id = :id");
        $query->bindValue(':id', $sinalID);
        $query->execute();
        $sql = $query->fetchAll(PDO::FETCH_ASSOC)[0];
        return $sql;
    }

    private function getDateTime($dateTimePicker) {
        $date = substr($dateTimePicker, 0, 10);
        $date = explode('/', $date);
        $time = explode(':',substr($dateTimePicker, -5, 5));
        return array_merge($date, $time);
    }

}

?>

