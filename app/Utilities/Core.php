<?php

use App\Loans;
use App\LoanPayments;
use App\LoanStatuses;
use App\InterestRateTypes;
use App\LoanDisbursements;
use App\InterestRatePeriods;
use App\DisbursementStatuses;
use App\LoanPaymentDurations;

if (! function_exists('getLoanBalance')) {
    /**
     * It returns the total loan balance of a customer
     * 
     * @param array data This is an array of data that you want to use to filter the loans.
     * 
     * @return int the total loan balance of a member.
     */
    function getLoanBalance(array $data) : int
    {
        try {
            $approved = LoanStatuses::where('code', '002')->first();

            $loans = Loans::where(array_merge($data, [
                'status' => $approved->id
            ]))->get();

            $overralloanamount = 0;

            for ($r = 0; $r < count($loans); $r++) {
                $disbursed = DisbursementStatuses::where('code', '002')
                    ->get()
                    ->first();

                $disbursement = LoanDisbursements::where([
                    'loan' => $loans[$r]->id,
                    'disbursement_status' => $disbursed->id
                ])->get()->first();

                if (isset($disbursement)) {
                    $overralloanamount = $overralloanamount + $loans[$r]->total_loan_amount;
                    $payments = LoanPayments::where('loan', $loans[$r]->id)->sum("amount");
                    $overralloanamount = $overralloanamount - $payments;
                }
            }

            return (int) abs($overralloanamount);
        } catch (\Throwable $th) {
            // throw $th;
            throw new Exception($th->getMessage());
        }
    }
}

if (! function_exists('calculateInterestCharged')) {
    /**
     * It calculates the interest charged on a loan
     * 
     * @param data This is the array of data that is passed to the function.
     * 
     * @return The interest charged on the loan.
     */
    function calculateInterestCharged($data)
	{
		$loans = new Loans();
		$interestRateType = InterestRateTypes::find($data['interest_rate_type']);
		$interestRateTypeCode = $interestRateType->code;
		$interestRatePeriod = InterestRatePeriods::find($data['interest_rate_period']);
		$interestRatePeriodDays = $interestRatePeriod->number_of_days;

		$loanPaymentDuration = LoanPaymentDurations::find($data['loan_payment_duration']);
		$loanPaymentDurationDays = $loanPaymentDuration->number_of_days;

		return $loans->getInterestCharged($data['loan_amount'], $data['interest_rate'], $interestRateTypeCode, $interestRatePeriodDays, $loanPaymentDurationDays);
	}
}

if (! function_exists('calculateAmountToBeDisbursed')) {
    /**
     * It calculates the amount to be disbursed to the customer
     * 
     * @param loanAmount The amount of the loan
     * @param interestCharged The interest charged on the loan
     * @param interestPaymentMethodCode This is the code for the interest payment method. It can be
     * either 001 (interest is paid upfront) or 002 (interest is paid at the end of the loan).
     * @param clearingFee The amount of money that will be deducted from the loan amount before it is
     * disbursed to the borrower.
     * @param insuranceDeductionFee This is the insurance fee that is deducted from the loan amount.
     * @param processingFee The processing fee charged on the loan
     * 
     * @return The amount to be disbursed.
     */
    function calculateAmountToBeDisbursed($loanAmount, $interestCharged, $interestPaymentMethodCode, $clearingFee, $insuranceDeductionFee, $processingFee)
    {
        if ($interestPaymentMethodCode == '001') {
            return ($loanAmount - $interestCharged - $clearingFee - $insuranceDeductionFee - $processingFee);
        } else {
            return ($loanAmount - $clearingFee - $insuranceDeductionFee - $processingFee);
        }
    }
}