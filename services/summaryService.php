<?php 
class SummaryService{

    public static function getTicketSaleSummary(){

        // $months = SummaryService::getMonthsWithSales();

        // $db = ConnectionDB::getInstance();

        // foreach($months as $month){

        //     $query = $db->prepare("SELECT * FROM flights f");
        //     $query->execute();
        //     $dbResult = $query->fetchAll(PDO::FETCH_OBJ);
        // }
        
        

        // $ticketSummary = array();

        // foreach ($dbResult as $dbObject) {
        //     $ticketSummary[] = new TableTicketSale(
        //         $dbObject->month, 
        //         $dbObject->sold_tickets, 
        //         $dbObject->total_sum
        //     );
        // }

        $db = ConnectionDB::getInstance();
        $query = $db->prepare("SELECT YEAR(o.purchase_date) AS year, MONTH(o.purchase_date) as month, COUNT(ticket_price) as sold_tickets, SUM(ticket_price) AS total_sum FROM occupations o INNER JOIN flights f ON f.id = o.flight_id GROUP BY YEAR(o.purchase_date), MONTH(o.purchase_date)");
        $query->execute();
        $dbResult = $query->fetchAll(PDO::FETCH_OBJ);

        $ticketSummary = array();

        foreach ($dbResult as $summary) {
            $ticketSummary[] = new TableTicketSale(
                        $summary->month, 
                        $summary->sold_tickets, 
                        $summary->total_sum
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