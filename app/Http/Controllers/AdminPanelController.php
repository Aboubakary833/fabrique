<?php

namespace App\Http\Controllers;

use App\Mail\registeringValidatedMail;
use App\Models\ReservationConfig;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminPanelController extends Controller
{
    public function index(Request $request) {

        if($request->session()->get('adminEmail') == null) return redirect('/');
        return view('pages/admin');
    }

    public function returnNewRegistered() {
        $newRegistered = DB::select('select userId,firstname, lastname, email from users where status = ?', ['passif']);
        return view('data/newbies')->with('newbies', $newRegistered);
    }

    public function returnReservation() {
        $reservations = DB::select('select r.reservationId,r.reservationAuthor,r.reservationConfigKey,r.reservationEnd,r.isValidated,
        rc.reservationConfigId, date_format(rc.reservationBegin, "%d/%m/%Y") as reservationBegin, date_format(rc.reservationEnd, "%d/%m/%Y") as reservationEnd,
        u.userId, u.firstname, u.lastname from reservations r inner join reservation_configs rc
        on r.reservationConfigKey = rc.reservationConfigId inner join users u on r.reservationAuthor = u.userId
        where r.isValidated = ? and (r.reservationEnd BETWEEN rc.reservationBegin and rc.reservationEnd) and rc.reservationConfigId = (select count(*) from reservation_configs)', ['no']);
        return view('data/reservations')->with('reservations', $reservations);

    }

    public function returnSubscribers() {
        $subscribers = DB::select('select userId, firstname, lastname, date_format(birthday, "%d/%m/%Y") as birthday, email from users where userId != ?', [1]);
        return view('data/subscribers')->with('subscribers', $subscribers);
    }

    public function returnBookers() {
        $bookers = DB::select('select r.reservationId, r.reservationAuthor, r.reservationConfigKey, r.isValidated,
        rc.reservationConfigId, date_format(rc.reservationBegin, "%d/%m/%Y") as reservationBegin, date_format(rc.reservationEnd, "%d/%m/%Y") as reservationEnd,
        u.userId, u.firstname, u.lastname from reservations r
        inner join reservation_configs rc on r.reservationConfigKey = rc.reservationConfigId
        inner join users u on r.reservationAuthor = u.userId
        where r.isValidated = ?', ['yes']);
        return view('data/bookers')->with('bookers', $bookers);
    }

    public function returnReservationForm() {
        $is_underway = DB::select('select * from reservation_configs order by reservationConfigId desc limit 1');
        if(count($is_underway) == 0) {
            $tomorrow = new DateTime(date_modify(date_create('now'), '1 day')->format('Y-m-d'));
            $end = new DateTime(date_modify(date_create(date('Y-m-d')), '8 day')->format('Y-m-d'));
            $interval = DateInterval::createFromDateString('1 day');
            $period = new DatePeriod($tomorrow, $interval, $end);
            $reservationsDays = [];
            $weekDays = [
                'Mon' => "Lundi",
                'Tue' => "Mardi",
                'Wed' => "Mercredi",
                'Thu' => "Jeudi",
                'Fri' => "Vendredi",
                'Sat' => "Samedi",
                'Sun' => 'Dimanche'
            ];
            foreach($period as $day) {
                $reservationsDays[$weekDays[$day->format('D')]] = $day->format('d/m/Y');
            }
            return view('data.reservationConfig')->with('reservationsDays', $reservationsDays);
        } else
        $currentReservationDate = [];
        foreach ($is_underway[0] as $key => $value) {
            $currentReservationDate[$key] = $value;
        }
        $dateTomanage = explode('-', $currentReservationDate['reservationBegin']);
        $managedDate = implode('-',[(int) $dateTomanage[0] -1, $dateTomanage[1], $dateTomanage[2]]);
        $currentReservationBegin = new DateTime($managedDate);
        $currentReservationDateEnd = new DateTime(date_modify(date_create($currentReservationDate['reservationEnd']), '-1 day')->format('Y-m-d'));
        $canNotConfigurePeriodObj = new DatePeriod($currentReservationBegin, DateInterval::createFromDateString('1 day'), $currentReservationDateEnd);
        $canNotConfigurePeriodArr = [];

        foreach ($canNotConfigurePeriodObj as $canNotConfigurePeriod) {
            array_push($canNotConfigurePeriodArr, $canNotConfigurePeriod->format('Y-m-d'));
        }

        if(in_array(date('Y-m-d'), $canNotConfigurePeriodArr)) return '<span class="empty">Une reservation est actuellement en cours!</span>';
        else {
        $tomorrow = new DateTime(date_modify(date_create('now'), '1 day')->format('Y-m-d'));
        $end = new DateTime(date_modify(date_create(date('Y-m-d')), '8 day')->format('Y-m-d'));
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($tomorrow, $interval, $end);
        $reservationsDays = [];
        $weekDays = [
            'Mon' => "Lundi",
            'Tue' => "Mardi",
            'Wed' => "Mercredi",
            'Thu' => "Jeudi",
            'Fri' => "Vendredi",
            'Sat' => "Samedi",
            'Sun' => 'Dimanche'
        ];
        foreach($period as $day) {
            $reservationsDays[$weekDays[$day->format('D')]] = $day->format('d/m/Y');
        }
        return view('data.reservationConfig')->with('reservationsDays', $reservationsDays);
        }

    }

    public function showProfil($id) {
        $user = DB::select('select userId, firstname, lastname, date_format(birthday, "%d%m%Y") as birthday, email, email_verified_at, created_at from users where userId = ?', [$id]);
        return view('pages/profile')->with('userInfos', $user);
    }

    public function validateRegister($id, $email) {
        DB::update('update users set status = "actif" where userId = ?', [$id]);
        $detail = [
            'title' => "Validation de votre inscription",
            'content' => "Votre inscription à la plateforme de reservation d'accès à la fabrique a été validé!\n
            Veuillez cliquer le liens en dessous pour vous connecter: ",
            'link' => "http://localhost:8000"
        ];
        Mail::to($email)->send(new registeringValidatedMail($detail));

        return redirect('admin');
    }

    public function deleteRegister($id) {
        DB::delete('delete from users where userId = ?', [$id]);
        return redirect('admin');
    }

    public function deleteSubscriber($id) {
        DB::delete('delete from users where userId = ?', [$id]);
        return redirect('admin');
    }

    public function validateEmail($email) {
        DB::update('update users set email_verified_at = NOW() where email = ?', [$email]);
        return view('pages.waiting');
    }

    public function validateReservation ($reservationId) {
        DB::update('update reservations set isValidated = "yes" where reservationId = ?', [$reservationId]);
        return redirect('/admin');
    }

    public function deleteReservation ($reservationId) {
        DB::delete('delete from reservations where reservationId = ?', [$reservationId]);
        return redirect('/admin');
    }

    public function workupReservation(Request $request) {

        $requestData = $request->all();
        array_shift($requestData);
        $reservationAmount = array_pop($requestData);
        $dataToSplit = [];
        $finalData = [];
        $reservations = [];
        $begin_and_end = [];

        foreach($requestData as $key => $value) {
            if($requestData[$key] != null) $dataToSplit[$key] = $value;
        }
            $dataToSplitKeys = array_keys($dataToSplit);
            array_push($begin_and_end, $dataToSplit[$dataToSplitKeys[0]], $dataToSplit[$dataToSplitKeys[count($dataToSplitKeys) - 3]]);

        $finalData = array_chunk($dataToSplit, 3, true);
        foreach ($finalData as $data) {
            $keys = array_keys($data);
            $reservations[array_key_first($data)] = [
                'date' => $data[$keys[0]],
                'BeginHour' => $data[$keys[1]],
                'EndHour' => $data[$keys[2]]
            ];
        }

        $begin = explode('/', $begin_and_end[0]);
        $reservationBegin = new DateTime($begin[2] . '-' . $begin[1] . '-' . $begin[0]);
        $end = explode('/', $begin_and_end[1]);
        $reservationEnd = new DateTime($end[2] . '-' . $end[1] . '-' . $end[0]);
        $dataToStore = [
            'reservationTotal' => $reservationAmount,
            'reservationBegin' => $reservationBegin,
            'reservationEnd' => $reservationEnd,
            'reservationPeriod' => json_encode($reservations)
        ];


        ReservationConfig::create($dataToStore);
        return redirect('/admin');
    }

    public function adminLogout(Request $request) {
        $request->session()->forget('adminEmail');
        return redirect('/');
    }
}
