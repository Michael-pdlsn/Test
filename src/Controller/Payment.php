<?php

namespace App\Controller;

use App\Entity\Transaction;
use App\Form\Type\TransactionType;
use App\Service\CardCheck;
use App\Service\SendCallBack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class Payment
 * @package App\Controller
 */
class Payment extends AbstractController
{
    /** @var CardCheck  */
    private $cardCheck;

    /** @var SendCallBack  */
    private $sendCallBack;

    public function __construct(CardCheck $cardCheck, SendCallBack $sendCallBack)
    {
        $this->cardCheck = $cardCheck;
        $this->sendCallBack = $sendCallBack;
    }

    /**
     * @Route("/form", name="get_form")
     */
    public function getPaymentForm(Request $request)
    {
        $refererUrl = $request->headers->get('referer');
        $callbackUrl = $request->get('callbackUrl');

        if(!$refererUrl){
          throw new \Exception('empty referer Url');
        }

        if(!$callbackUrl){
          throw new \Exception('empty callbackUrl');
        }

        $cards = ['true' => $this->getParameter('card_true'), 'false' => $this->getParameter('card_false')];

        $transaction = new Transaction();
        $transaction->setCallBackUrl($callbackUrl);
        $transaction->setRefererUrl($refererUrl);

        $form = $this->createForm(TransactionType::class, $transaction, [
            'action' => $this->generateUrl('validate_form'),
            'method' => 'POST',
        ]);


        return $this->render('payment.html.twig', [
            'form' => $form->createView(),
            'cards' => $cards
        ]);
    }

    /**
     * @Route("/validate", name="validate_form")
     */
    public function validateForm(Request $request)
    {
        $transaction = new Transaction();

        $form = $this->createForm(TransactionType::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var Transaction $transaction */
            $transaction = $form->getData();

            $cardNumber = $transaction->getCardNumber();
            $callBackUrl = $transaction->getCallBackUrl();
            $refererUrl = $transaction->getRefererUrl();

            $resultStatus = $this->cardCheck->checkCard($cardNumber);

            /** @todo  move this to RabbitMQ Queue */
            $status = $this->sendCallBack->send($callBackUrl, $resultStatus);

            return $this->render('result.html.twig', [
                'refererUrl' => $refererUrl,
                'resultStatus' => $resultStatus
            ]);

        }

        return $this->render('payment.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/", name="main")
     */
    public function mainPage()
    {
        return $this->render('test.html.twig');
    }
}