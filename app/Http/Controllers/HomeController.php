<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use DateInterval;

class HomeController extends Controller
{



    public function index(Request $request)
    {
        if($request->session()->has('userEmail') == false) return redirect('/');
        $userReq = DB::select('select * from users where email = ?', [$request->session()->get('userEmail')]);
        $userData = [];
        $bookingReq = DB::select('select * from reservation_configs');
        $currentBooking = [];
        foreach ($userReq[0] as $key => $value) {
            $userData[$key] = $value;
        }
        foreach ($bookingReq[count($bookingReq) - 1] as $key => $value) {
            $currentBooking[$key] = $value;
        }
        $checkData = [
            $userData['userId'],
            date('d-M-Y'),
            $currentBooking['reservationEnd']

        ];
        $bookingNum = DB::select('select * from reservations where reservationConfigKey = ?', [$currentBooking['reservationConfigId']]);

        $check = DB::select('select * from reservations where reservationAuthor = ? and (reservationEnd between ? and ?)', $checkData);
        return view('pages/home')->with('infos', [$check, $bookingNum]);
    }

    public function logout(Request $request) {
        $request->session()->forget('userEmail');
        return redirect('/');

    }

    public function weekBooking(Request $request) {
        $userReq = DB::select('select * from users where email = ?', [$request->session()->get('userEmail')]);
        $userData = [];
        $bookingReq = DB::select('select * from reservation_configs');
        $currentBooking = [];
        foreach ($userReq[0] as $key => $value) {
            $userData[$key] = $value;
        }
        foreach ($bookingReq[count($bookingReq) - 1] as $key => $value) {
            $currentBooking[$key] = $value;
        }
        $reservationData = [
            $userData['userId'],
            $currentBooking['reservationConfigId'],
            date('Y-m-d'),
            $currentBooking['reservationEnd'],
            'no'
        ];
        DB::insert('insert into reservations (reservationAuthor, reservationConfigKey, reservationBegin, reservationEnd, isValidated) values (?, ?, ?, ?, ?)', $reservationData);
    }

    public function todayBooking(Request $request) {
        $userReq = DB::select('select * from users where email = ?', [$request->session()->get('userEmail')]);
        $userData = [];
        $bookingReq = DB::select('select * from reservation_configs');
        $currentBooking = [];
        foreach ($userReq[0] as $key => $value) {
            $userData[$key] = $value;
        }
        foreach ($bookingReq[count($bookingReq) - 1] as $key => $value) {
            $currentBooking[$key] = $value;
        }
        $reservationData = [
            $userData['userId'],
            $currentBooking['reservationConfigId'],
            date('Y-m-d'),
            date('Y-m-d'),
            'no'
        ];
        DB::insert('insert into reservations (reservationAuthor, reservationConfigKey, reservationBegin, reservationEnd, isValidated) values (?, ?, ?, ?, ?)', $reservationData);
    }
}
