@extends('layouts.web.app')

@section('title', 'Jobs Post - Empex')

@section('navbar')
    @parent
@endsection
@section('content')
    <div class="max-w-7xl mx-auto px-4 my-10">
        <div class="w-full">
            <div class=" text-xl text-center font-bold ml-5 my-3">
                REFUND/CANCELLATION POLICY
            </div>
            <div class="mx-5">
               
                <div>
                    Applicants have to ensure that Transaction Reference Number has been generated and if the same has not been generated, 
                    she/he has to make the payment of bill afresh to ensure delivery of Employment registration application. 
                    Refund of the money due to above unsuccessful transaction the applicants has to take up the matter with the respective 
                    issuer bank. Department of Labour, Employment, Skill Development & Entrepreneurship, Government of Mizoram will not be
                     responsible for such refund.<br/><br/>
                </div>
               
                <div>
                    There are three ways of transaction flow:-
                    <br/>
                    1.  Amount is debited from applicants' account and success message is shown in Department of Labour, Employment, Skill Development & Entrepreneurship, 
                    Government of Mizoram portal. Connection does not break<br/>
                    2.	Connection breaks before amount is debited from user's account. There should not be any issue as Citizen's bank/card account is not debited.<br/>
                    3.	Connection breaks after amount is debited from user's account but payment status is not shown in Department of Labour,
                     Employment, Skill Development & Entrepreneurship, Government of Mizoram's Employment Exchange portal. Successful payments will
                      be settled during reconciliation process between Department of Labour, Employment, Skill Development & Entrepreneurship,
                       Government of Mizoram and Designated Bank. The applicants can pay again to make sure that he/she gets transaction receipt.
                        In case of double (or multiple payment) of same fees.<br/>
                    
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