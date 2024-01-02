<?php
include("header.php");
?>
<div id="block" class="section-area content-inner service-info-bx">

</div>
<script src="./auth/js/jquery.js"></script>
	<script>
			let load_flag=0;
            loadMore(load_flag);
            let a=5;
            function loadMore(start){
                jQuery.ajax({
                url:'get.php',
                data:'start='+start,
                type:'post',
                success:function(result){
                    jQuery('#block').append(result);
                    load_flag += 3;
                    }
                });
            }
            function loadAgain(){
                setTimeout(()=>{
			    loadMore(load_flag);
                if(a>10){
                    loadAgain();
                    a++;
                }
			    },1000);
                
            }
			loadAgain();
	</script>
<?php
include("footer.php");
?>