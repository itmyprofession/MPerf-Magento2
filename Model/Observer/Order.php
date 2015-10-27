<?php
namespace Tym17\MailPerformance\Model\Observer;

class Order
{
    protected $_msgManager;


    public function __construct(
        \Magento\Framework\Message\ManagerInterface $msgManager
    ) {
        $this->_msgManager = $msgManager;
    }

    public function salesOrderPaymentPay()
    {
        $this->_msgManager->addWarning(__('salesOrderPaymentPay'));
    }

    public function salesOrderPaymentRefund()
    {
        $this->_msgManager->addWarning(__('salesOrderPaymentRefund'));
    }








    public function checkoutCartAddProductComplete()
    {
        $this->_msgManager->addWarning(__('checkoutCartAddProductComplete'));
    }

    public function checkoutCartProductAddAfter()
    {
        $this->_msgManager->addWarning(__('checkoutCartProductAddAfter'));
    }

    public function checkoutCartSaveAfter()
    {
        $this->_msgManager->addWarning(__('checkoutCartSaveAfter'));
    }





    public function checkoutCartUpdateItemComplete()
    {
        $this->_msgManager->addWarning(__('checkoutCartUpdateItemComplete'));
    }

    public function checkoutCartUpdateItemsAfter()
    {
        $this->_msgManager->addWarning(__('checkoutCartUpdateItemsAfter'));
    }

    public function checkoutCartProductUpdateAfter()
    {
        $this->_msgManager->addWarning(__('checkoutCartProductUpdateAfter'));
    }






    public function checkoutOnepageControllerSuccessAction()
    {
        $this->_msgManager->addWarning(__('checkoutOnepageControllerSuccessAction'));
    }




    public function checkoutTypeOnepageSaveOrderAfter()
    {
        $this->_msgManager->addWarning(__('checkoutTypeOnepageSaveOrderAfter'));
    }






    public function salesModelServiceQuoteSubmitSuccess()
    {
        $this->_msgManager->addWarning(__('salesModelServiceQuoteSubmitSuccess'));
    }







    public function salesOrderInvoiceCancel()
    {
        $this->_msgManager->addWarning(__('salesOrderInvoiceCancel'));
    }

    public function salesOrderPaymentCancelInvoice()
    {
        $this->_msgManager->addWarning(__('salesOrderPaymentCancelInvoice'));
    }

    public function salesOrderPaymentCancel()
    {
        $this->_msgManager->addWarning(__('salesOrderPaymentCancel'));
    }





    public function customerRegisterSuccess()
    {
        $this->_msgManager->addWarning(__('customerRegisterSuccess'));
    }






    public function checkoutControllerOnepageSaveOrder()
    {
        $this->_msgManager->addWarning(__('checkoutControllerOnepageSaveOrder'));
    }




    public function salesModelServiceQuoteSubmitFailure()
    {
        $this->_msgManager->addWarning(__('salesModelServiceQuoteSubmitFailure'));
    }

}
