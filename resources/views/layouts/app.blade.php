<!DOCTYPE html>
<html>

<head>
	<title>To Do</title>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
	 crossorigin="anonymous">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
	 crossorigin="anonymous">
	<link rel="stylesheet" href="/css/app.css">
</head>

<body>
	<div class="container">
	@include('inc.messages') @yield('content')
	</div>

	{{-- would normally go in public/css --}}
	<style>
		body {
			background-color: #EEEEEE;
			padding-top: 20px;
		}

		h3 {
			margin-left: 3px;
		}

		.space {
			width: 90%;
			margin-left: 20px;
		}

		#done-items {
			text-align: center;
			padding: 10px 0;
			border-bottom: 1px solid #ddd;
			margin-bottom: 20px;
		}

		.mark-complete {
			margin: 10px;
			border-top: 1px solid #ddd;
		}

		.card {
			padding: 10px;
		}
	</style>

	<script>
		$(function() {

			//hide complete button on load
			$('.mark-complete').hide();
			
			//show/hide completed msgs vs list
			if(isCompleted > 0)
			{
				$('#done-items').hide(); 
				$('#completed-items').show(); 
			}
			
			//for checkbox change event
            $('.compcheck').change(function() {
                if($('.compcheck:checked').length) {
                    $('.mark-complete').show();

                    return;
                }

                $('.mark-complete').hide();
            });
		  
		//for completed button click	
		$("#completebtn").click(function(){
            var completed = [];
            $.each($(".compcheck:checked"), function(){            
                completed.push($(this).val());
            });

			const url = './todos/completed/';

		//from my snipets	
		$.ajax({
            timeout: 1000,
            url: url,
            type: "GET",
            dataType: 'text',
            data: {data:JSON.stringify(completed)}, //this could be any data we have to pass
            success: function(resp) 
			{
					alert('Task Completed');
					location.reload();
			},
            error: function(xhr, textStatus, errorThrown) {
                alert(errorThrown);
            }
			});

        });
        });
	</script>
</body>

</html>