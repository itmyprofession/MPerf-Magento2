<?php
namespace Tym17\MailPerformance\Model\Observer;

class OnPageLoad
{
    protected $_msgManager;


    public function __construct(
        \Magento\Framework\Message\ManagerInterface $msgManager
    ) {
        $this->_msgManager = $msgManager;
    }

    public function salesOrderPaymentPay()
    {
        $msgManager->addWarning(__('salesOrderPaymentPay')));
    }

    public function salesOrderPaymentRefund()
    {
        $msgManager->addWarning(__('salesOrderPaymentRefund')));
    }








    public function checkoutCartAddProductComplete()
    {
        $msgManager->addWarning(__('checkoutCartAddProductComplete')));
    }

    public function checkoutCartProductAddAfter()
    {
        $msgManager->addWarning(__('checkoutCartProductAddAfter')));
    }

    public function checkoutCartSaveAfter()
    {
        $msgManager->addWarning(__('checkoutCartSaveAfter')));
    }





    public function checkoutCartUpdateItemComplete()
    {
        $msgManager->addWarning(__('checkoutCartUpdateItemComplete')));
    }

    public function checkoutCartUpdateItemsAfter()
    {
        $msgManager->addWarning(__('checkoutCartUpdateItemsAfter')));
    }

    public function checkoutCartProductUpdateAfter()
    {
        $msgManager->addWarning(__('checkoutCartProductUpdateAfter')));
    }






    public function checkoutOnepageControllerSuccessAction()
    {
        $msgManager->addWarning(__('checkoutOnepageControllerSuccessAction')));
    }




    public function checkoutTypeOnepageSaveOrderAfter()
    {
        $msgManager->addWarning(__('checkoutTypeOnepageSaveOrderAfter')));
    }






    public function salesModelServiceQuoteSubmitSuccess()
    {
        $msgManager->addWarning(__('salesModelServiceQuoteSubmitSuccess')));
    }







    public function salesOrderInvoiceCancel()
    {
        $msgManager->addWarning(__('salesOrderInvoiceCancel')));
    }

    public function salesOrderPaymentCancelInvoice()
    {
        $msgManager->addWarning(__('salesOrderPaymentCancelInvoice')));
    }

    public function salesOrderPaymentCancel()
    {
        $msgManager->addWarning(__('salesOrderPaymentCancel')));
    }







    public function customQuoteProcess()
    {
        $msgManager->addWarning(__('customQuoteProcess')));
    }






    public function customerRegisterSuccess()
    {
        $msgManager->addWarning(__('customerRegisterSuccess')));
    }






    public function checkoutControllerOnepageSaveOrder()
    {
        $msgManager->addWarning(__('checkoutControllerOnepageSaveOrder')));
    }




    public function salesModelServiceQuoteSubmitFailure()
    {
        $msgManager->addWarning(__('salesModelServiceQuoteSubmitFailure')));
    }

}
