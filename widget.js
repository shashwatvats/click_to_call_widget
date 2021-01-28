$(document).ready(function(){
	
	var html_code=`<div>
		<button style="position: fixed; right: 5%;top:85%;border: none;color: black;border: 2px solid #008CBA;
		border-radius: 10px;padding: 10px 15px;background-color:white; font-weight: bold;" 
		onMouseOver="this.style.backgroundColor='#008CBA'" onMouseOut="this.style.backgroundColor='white'"><i class="fa fa-phone fa-lg" 
    aria-hidden="true"></i>Call Now</button>
	</div>`;

	var popup_html=`<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Please Select...</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <a href="tel:+918700279328" class="btn btn-success" id="call_now" role="button"><i class="fa fa-phone"></i> Call Now</a>
          <button type="button" id="request_btn" class="btn btn-primary"><i class="fa fa-upload"></i> Request A Call</button>
        </div>
       	
        <div id="myformdiv" class="modal-body">
        <form id="myform">
		    <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-user fa-fw"></i></span>
          </div>
		      <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name" required>
		    </div>
		    <div class="input-group mb-3">
		      <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-envelope fa-fw"></i></span>
          </div>
		      <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email" required>
		    </div>
		    <div class="input-group">
		      <div class="input-group-prepend">
            <span class="input-group-text"><i class="fa fa-tablet fa-fw"></i></span>
          </div>
		      <input type="number" class="form-control" id="number" name="number" placeholder="Enter Your Phone Number" required>
		    </div><br>
		    <button type="submit" id="submit" class="btn btn-info">Submit <i class="fa fa-send"></i></button>
		  </form>
        </div>
        <p id="success"></p>
      </div>
    </div>
  </div>`;

  	var flag=true;

	$('.call').html(html_code);
  	$('.call').click(function(e){
  		$('.call').append(popup_html);
  		$("#myModal").modal();
  		if (flag) {
  			$('#myform').hide();
  			flag=false;
  		}		
  		});
  	$(document).on('click','.close',function(){
  		flag=true;
  	});
  	$(document).on('click','#request_btn',function(e){
  		$('#myform').show();
  		//alert("bhjbh");
  	});
  	$(document).on('submit','#myform',function(e){
  		e.preventDefault();
  		var name=$('#name').val();
  		var email=$('#email').val();
  		var number=$('#number').val();
  		$.ajax({
			url:"request_call.php",
			method:'POST',
			data:{
				name:name,
				email:email,
				number:number
			},
			success:function(data)
			{	
				if (data) {
					$("#myform")[0].reset();
				 	$("#success").html(data);
			   }
				 
			}
		});

      setInterval(function(){
      $('#success').html('');
    },2000);

  	});
});
