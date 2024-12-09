<?php 
class SummaryService{

    public static function getTicketSaleSummary(){

        $months = SummaryService::getMonthsWithSales();

        $db = ConnectionDB::getInstance();

        foreach($months as $month){

            $query = $db->prepare("SELECT * FROM flights f");
            $query->execute();
            $dbResult = $query->fetchAll(PDO::FETCH_OBJ);
        }
        
        

        $ticketSummary = array();

        foreach ($dbResult as $dbObject) {
            $ticketSummary[] = new TableTicketSale(
                $dbObject->month, 
                $dbObject->sold_tickets, 
                $dbObject->total_sum
            );
        }

        return $ticketSummary;
    }

    public static function getOccupationSummary(){

        $db = ConnectionDB::getInstance();
        $query = $db->prepare("SELECT f.code, f.departure_date, (SELECT count(*) FROM occupations o where o.flight_id = f.id) as 'seats_ocupied' FROM flights f ");
        $query->execute();
        $dbResult = $query->fetchAll(PDO::FETCH_OBJ);

        $response = array();

        foreach($dbResult as $result){
            $response[] = new TableOccupationSummary(
                $result->code,
                $result->departure_date,
                $result->seats_ocupied
            );
        }

        return $response;
    }

    private static function getMonthsWithSales(){

        $db = ConnectionDB::getInstance();
        $query = $db->prepare("SELECT DISTINCT MONTH(o.purchase_date) as 'month' from occupations o ");
        $query->execute();
        $dbResult = $query->fetchAll(PDO::FETCH_OBJ);

        return $dbResult;
    }
}


?>