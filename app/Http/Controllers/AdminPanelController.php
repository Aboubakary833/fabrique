<?php

namespace App\Http\Controllers;

use App\Mail\registeringValidatedMail;
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

    public function configReservation (Request $request) {

        $reservationTotal = $request->input('reservationTotal');
        $reservationEnd = $request->input('reservationEnd');
        DB::insert('insert into reservation_configs (reservationNum, reservationTotal, reservationBegin, reservationEnd) values (0, ?, CURDATE(), ?)', [$reservationTotal, $reservationEnd]);
        return redirect('/admin');
    }

    public function adminLogout(Request $request) {
        $request->session()->forget('adminEmail');
        return redirect('/');
    }
}
