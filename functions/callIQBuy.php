<?php

include_once "db-connect.php";
class CallIQBuy {

    function __construct($sinalID,$pass,$db) {
        $this->dir = dirname(dirname(__FILE__));
        $sinalDetail = $this->getSinalDetails($sinalID, $db);
        $userInfo = $this->getUsers($sinalDetail['user_id'], $db);
        $this->timestampSinal = $this->getSinalTimestamp($sinalDetail['data_sinal']);
        $this->user = $userInfo['user_id'];
        $this->pass = $pass;
        $this->sinalID = $sinalID;
        $this->moeda = $sinalDetail['cod'];
        $this->duration = $sinalDetail['expiracao'];
        $this->valor = $sinalDetail['valor'];
        $this->direction = $sinalDetail['direcao'];
        $this->usa_gale = $sinalDetail['usa_gale'];
    }
    public function buyOrder($db) {
        while (true) {
            if(strtotime('-3 hours') == $this->timestampSinal) {
                $result = $this->callBuyOrder();
                if($result != 'error' || !empty($result)){
                    $result = explode(' ',$result);
                    if($result[0] == 'win') {
                        $data['gale'] = 0;
                        $data['result'] = 'Ganhou';
                        $data['lucro'] = round(floatval($result[1]), 2);
                        $this->postResult($data, $db);
                        return false;
                    }
                    else {
                        if($this->usa_gale == 0) {
                            $data['gale'] = 0;
                            $data['result'] = 'Perdeu';
                            $data['lucro'] = round(floatval($result[1]), 2);
                            $this->postResult($data, $db);
                            return false;
                        }
                        $this->valor = $this->valor * 2;
                        $time = $this->duration * 52;
                        sleep($time);
                        $result = $this->callBuyOrder();
                        if($result != 'error' || !empty($result)){
                            $result = explode(' ',$result);
                            if($result[0] == 'win') {
                                $data['gale'] = 1;
                                $data['result'] = 'Ganhou';
                                $data['lucro'] = round(floatval($result[1]), 2);
                                $this->postResult($data, $db);
                                return false;
                            } 
                            else {
                                $this->valor = $this->valor * 2;
                                $time = $this->duration * 52;
                                sleep($time);
                                $result = $this->callBuyOrder();
                                if($result != 'error' || !empty($result)){
                                    $result = explode(' ',$result);
                                    if($result[0] == 'win') {
                                        $data['gale'] = 2;
                                        $data['result'] = 'Ganhou';
                                        $data['lucro'] = round(floatval($result[1]), 2);
                                        $this->postResult($data, $db);
                                        return false;
                                    } 
                                    else {
                                        $data['gale'] = 2;
                                        $data['result'] = 'Perdeu';
                                        $data['lucro'] = round(floatval($result[1]), 2);
                                        $this->postResult($data, $db);
                                        return false;
                                    } 
                                }
                                else {
                                    echo "Erro ao iniciar a compra.";
                                    return false;
                                }    
                            } 
                        }
                        else {  
                            echo "Erro ao iniciar a compra.";
                            return false;
                        }     
                    }
                }
                else {
                    echo "Erro ao iniciar a compra.";
                    return false;
                }
            }    
        }
    }

    private function callBuyOrder() {
        return exec("/usr/bin/python $this->dir/functions/python/mainFunctions.py $this->user $this->pass 1 $this->moeda $this->duration $this->valor $this->direction False 2>&1");
    }

    private function getSinalTimestamp($dateTimePicker) {
        $dateTimePicker = str_replace('/','-',$dateTimePicker);
        return strtotime($dateTimePicker) - 8;
    }
    
    private function getSinalDetails($sinalID, $db) {
        $query = $db->prepare("SELECT snl.id, moeda.cod, data_sinal, usa_gale, direcao, expiracao, valor, user_id FROM sinal AS snl INNER JOIN moedas AS moeda ON moeda.id = snl.moeda_id WHERE snl.id = :id");
        $query->bindValue(':id', $sinalID);
        $query->execute();
        $sql = $query->fetchAll(PDO::FETCH_ASSOC)[0];
        return $sql;
    }

    private function getUsers($userID, $db) {
        $query = $db->prepare("SELECT user_id FROM users WHERE id = :id");
        $query->bindValue(':id', $userID);
        $query->execute();
        $sql = $query->fetchAll(PDO::FETCH_ASSOC)[0];
        return $sql;
    }
    
    private function postResult($data, $db) {
        $sth = $db->prepare("UPDATE sinal SET gale = :gale, result = :result, lucro_preju = :lucro WHERE id = :id"); 
        $id = $this->sinalID;
        $result = $data['result'];
        $gale = $data['gale'];
        $lucro = $data['lucro'];
        $sth->bindValue(':id', $id);
        $sth->bindValue(':result', $result);
        $sth->bindValue(':gale', $gale);
        $sth->bindValue(':lucro', $lucro);
        $sth->execute();
    }
}
$sinalID = $argv[1];
$pass = base64_decode($argv[2]);
$buyOrder = new CallIQBuy($sinalID, $pass, $db);
$buyOrder->buyOrder($db);


?>