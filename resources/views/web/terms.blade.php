@extends('layouts.web.app')

@section('title', 'Jobs Post - Empex')

@section('navbar')
    @parent
@endsection
@section('content')
    <div class="max-w-7xl mx-auto px-4 my-10">
        <div class="w-full">
            <div class=" text-xl text-center font-bold ml-5 my-3">
              Terms and Conditions
            </div>
            <div class="mx-5">
                <div class="font-bold">
                    Payment Gateway/ Net Banking Disclaimer
                </div>
                <div>
                    Employment registration fees payments made by you to the Department may be made through an
                     electronic and automated collection and remittance service (the "Payment Gateway" & " 
                     Internet Banking") hosted by Department of Labour, Employment, Skill Development & Entrepreneurship,
                      Government of Mizoram's designated bank. The Payment Gateway/ Internet Banking service is provided 
                      to you in order to facilitate access to view and pay your Employment registration fees online. Department
                       of Labour, Employment, Skill Development & Entrepreneurship, Government of Mizoram makes no representation 
                       of any kind, express or implied, as to the operation of the Payment Gateway. You expressly agree that your 
                       use of this online payment service is entirely at your own risk.<br/><br/>
                </div>
                <div class="font-bold">
                    Transaction charge
                </div>
                <div>
                    Transaction charge will be borne by citizens. Transaction and Aggregation Related fees are given below:-
                    <br/>
                    1.	There will be no transaction charges using Unified Payment Interface (UPI) Payments.<br/>
                    2.	Net Banking Facility Fee : Rs. 5/- plus Service Tax Per transaction processed below Rs.500.00.<br/>
                    3.	Credit Card Gateway Facility Fee (Visa, MasterCard) : 1.00% of Transaction Value plus Service Tax.<br/>
                    4.	Debit Card Gateway Facility Fee (Visa, MasterCard/Ru-pay) below Rs.2000.00 : 0.75% of Transaction Value plus Service Tax per transaction processed below Rs.2000.00.<br/>
                    5.	Electronic Transaction processing fee for Wallets and cash cards : Rs.5/- of Transaction Value plus Service Tax Per transaction..<br/>
                    <br/><br/>
                </div>
                <div class="font-bold">
                    Receipt generation
                </div>
                <div>
                    You will get receipt of exact bill amount paid by you. An e-mail will also be sent to your registered e-mail address mentioning
                     the payment information.<br/><br/>
                </div>
                <div class="font-bold">
                    Limitation of Liability
                </div>
                <div>
                    Department of Labour, Employment, Skill Development & Entrepreneurship,
                     Government of Mizoram has made this service available to you as a matter of convenience.Department of Labour, Employment, 
                     Skill Development & Entrepreneurship, Government of Mizoram expressly disclaims any claim or liability arising out of the provision 
                     of this service. You agree and acknowledge that you shall be solely responsible for your conduct and that Department of Labour, Employment, 
                     Skill Development & Entrepreneurship, Government of Mizoram reserves the right to terminate your rights to use the service immediately.<br/>
                     In no way shall Department of Labour, Employment, Skill Development & Entrepreneurship, Government of Mizoram or its affiliates
                      be liable for any direct, indirect, incidental, special, consequential or exemplary damages. Including but not limited to, damages 
                      for loss of profits, goodwill, data or other intangible losses arising out of or in connection with use of the Payment Gateway.<br/>
                      Department of Labour, Employment, Skill Development & Entrepreneurship, Government of Mizoram assumes no liability whatsoever for 
                      any monetary or other damage suffered by you on account of (i) the delay, failure. interruption, or corruption of any data or other 
                      information transmitted in connection with use of the Payment Gateway/ Internet Banking; or (ii) any interruption or errors 
                      in the operation of the Payment Gateway/ Internet Banking.<br/>
                      You shall indemnify and hold harmless Department of Labour, Employment, Skill Development & Entrepreneurship. Government of Mizoram and their respective officers, affiliates, agents, and employees, from any claim or demand, or actions.<br/>
                      You agree, understand and confirm that personal data including without limitation details relating to Debit Card/Credit Card/ 
                      Net Banking transmitted over the internet is susceptible to misuse, theft and/or fraud and that Department of Labour, Employment, 
                      Skill Development & Entrepreneurship, Government of Mizoram has no control over such matters. Although all reasonable care
                       has been taken towards guarding against unauthorized use of any information transmitted by you, Department of Labour, Employment,
                        Skill Development & Entrepreneurship. Government of Mizoram does not represent or guarantee that the use of the Payment Gateway/ 
                        Internet Banking will not result in theft and/or unauthorized use of data over the internet. Debit card / Credit card / Net banking
                         details provided by you for use of the Payment Gateway/ Internet Banking will be correct and accurate and you shall not use a 
                         Debit Card/Credit Card/Net Banking which is not lawfully owned by you. You further agree and undertake to provide correct and 
                         valid Debit Card/Credit Card/Net Banking details. In default of the above conditions the Department of Labour, Employment,
                          Skill Development & Entrepreneurship, Government of Mizoram shall be entitled to recover the amount of transaction from the
                           consumer against whose Credit Card/Debit Card/Net Banking has been used. Further. the Department of Labour, Employment,
                            Skill Development & Entrepreneurship, Government of Mizoram also reserves the right to initiate any legal action for recovery of
                             cost / penalty or any other punitive measure, as it may deem fit.
<br/><br/>
                </div>
                
                
            </div>  
        </div>
     
    </div>
@endsection

@section('footer')
    @parent
@endsection

@section('copyright')
    @parent
@endsection

<script type="module">
	document.getElementById("search").addEventListener("search", function(event) {
    document.getElementById("searchForm").submit();
	});

	$(document).on('change', '.sortJob, .filterJob', function () {
		$('#searchForm').submit();
	})
</script>