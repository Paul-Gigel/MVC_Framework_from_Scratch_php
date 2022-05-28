<?php
namespace app\controllers;

use paul_core\paul_core\Application;
use paul_core\paul_core\Controller;
use paul_core\paul_core\Request;
use paul_core\paul_core\Response;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function home(): string
    {
        $params = [
            'name' => "Paul Gigel"
        ];
        return $this->render('home', $params);
    }
    public function contact(Request $request, Response $response): string
    {
        $contact = new ContactForm();
        if ($request->isPost()) {
            $contact->loadData($request->getBody());
            if ($contact->validate() && $contact->send())   {
                Application::$app->session->setFlash('succes', 'Thanks for contacting us');
                return $response->redirect('/contact');
            }
        }
        return $this->render('contact',[
            'model' => $contact
        ]);
    }
}