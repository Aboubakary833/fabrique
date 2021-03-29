<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Reservations;
use DateInterval;
use DatePeriod;
use DateTime;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if($request->session()->has('userEmail') == false) return redirect('/');

        $unexploitableReservationData = DB::select('select * from reservation_configs order by reservationConfigId desc limit 1');
        $unexploitableUserData = DB::select('select * from users where email = ?', [$request->session()->get('userEmail')]);

        if(!count($unexploitableReservationData)) return view('pages.home')->with('no_booking', "Aucune serie de reservation n'a été mise en place");

        $exploitableReservationData = [];
        $exploitableUserData = [];

        foreach($unexploitableReservationData[0] as $key => $value) {
            $exploitableReservationData[$key] = $value;
        }
        foreach($unexploitableUserData[0] as $key => $value) {
            $exploitableUserData[$key] = $value;
        }

        $toChecks = [
            $exploitableUserData['userId'],
            $exploitableReservationData['reservationConfigId']
        ];

        $userReservation_underway = DB::select('select * from reservations where reservationAuthor = ? and reservationConfigKey = ?', $toChecks);

        if(count($userReservation_underway)) return view('pages.home')->with('is_underway', 'Vous avez déja une reservation en cours!');
        else {

            $configuredReservationPeriod = [];
            $canReserve = [];
            $configuredReservationEnd = $exploitableReservationData['reservationEnd'];
            $canReserveBegin = new DateTime(date_modify(date_create('now'), '1 day')->format('Y-m-d'));
            $canReserveEnd = new DateTime(date_modify(date_create($configuredReservationEnd), '1 day')->format('Y-m-d'));
            $canReservePeriodArr = [];
            $canReservePeriodObj = new DatePeriod($canReserveBegin, DateInterval::createFromDateString('1 day'), $canReserveEnd);

            foreach ($canReservePeriodObj as $value) {
                array_push($canReservePeriodArr, $value->format('Y-m-d'));
            }

            foreach (json_decode($exploitableReservationData['reservationPeriod']) as $key => $value_in_obj_format) {
                $value = [];
                foreach ($value_in_obj_format as $k => $v) {
                    $value[$k] = $v;
                }
                $configuredReservationPeriod[$key] = $value;
            }

            foreach ($configuredReservationPeriod as $key => $value) {
                if(in_array(implode('-', array_reverse(explode('/', $value['date']))), $canReservePeriodArr)) {
                    $canReserve[$key] = $value;
                }
            }

            return view('pages.home')->with('data', [$exploitableReservationData['reservationTotal'], $canReserve, $exploitableReservationData['reservationEnd']]);

        }

    }

    public function logout(Request $request) {
        $request->session()->forget('userEmail');
        return redirect('/');

    }

    public function booking(Request $request) {

        $reservationPeriod = [];
        $userReq = DB::select('select * from users where email = ?', [$request->session()->get('userEmail')]);
        $userData = [];
        $bookingReq = DB::select('select * from reservation_configs order by reservationConfigId desc limit 1');
        $currentBooking = [];
        $reserv_request = $request->all();
        array_shift($reserv_request);
        $reservationEnd = array_pop($reserv_request);
        foreach ($reserv_request as $key => $value) {
            $explodeValue = explode(',', $value);
            $reservationPeriod[$key] = [
                "date" => $explodeValue[0],
                "BeginHour" => $explodeValue[1],
                "EndHour" => $explodeValue[2]
            ];
        }
        foreach($userReq[0] as $key => $value) {
            $userData[$key] = $value;
        }
        foreach($bookingReq as $key => $value) {
            foreach ($value as $k => $v) {
                $currentBooking[$k] = $v;
            }
        }


        $remainning_reservation = (int) $currentBooking['reservationTotal'] > 0 ? (int) $currentBooking['reservationTotal'] - 1 : 0;

        $reservationData = [
            'reservationAuthor' => $userData['userId'],
            'reservationConfigKey' => $currentBooking['reservationConfigId'],
            'userReservationPeriod' => json_encode($reservationPeriod),
            'reservationEnd' => $reservationEnd,
            'isValidated' => 'no'
        ];
        Reservations::create($reservationData);
        DB::update('update reservation_configs set reservationTotal = ? where reservationConfigId = ?', [$currentBooking['reservationConfigId'], $remainning_reservation]);
        return redirect('/home');
    }
}
