
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Sun Shine</title>
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<link rel="stylesheet" 
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css">
<link rel="stylesheet" 
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<link rel="stylesheet" 
    type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<style type="text/css">
a:hover{
    text-decoration: none;
}

h2 {
    color: blue;
    background-color: transparent;
    border-bottom: 1px solid #D0D0D0;
    font-size: 19px;
    font-weight: normal;
    margin: 0 0 14px 0;
    padding: 14px 15px 10px 15px;
}

label {
    color: purple
}


p {
    margin: 12px 15px 12px 15px;
    color:red;
}

i {
    cursor: pointer;
    text-decoration: none;
}
img {
    margin-top: 10px;
    border: 1px solid #D0D0D0;
    box-shadow: 0 0 8px #D0D0D0;
    height:300px;
    width:300px;
    
}
h3{
    color:pink;
}
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 33.33%;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.container {
  padding: 2px 16px;
}

.form-control {
    color:blue;
}
</style>
</head>
<body>



<?php echo !empty($statusMsg)?'<p class="status-msg">'.$statusMsg.'</p>':''; ?>
<h2> Hello,You can upload Your Photos Now</h2>
<!-- File upload form -->
<form method="post" action="index" enctype="multipart/form-data">
    <div class="form-group">
        <label>Choose Files</label>
        <input type="file" class="form-control" name="files[]" multiple/>
    </div>
    <div class="form-group">
        <input class="form-control" type="submit" name="fileSubmit" value="UPLOAD"/>
    </div>
</form>

<div class="row">
    <h3>Uploaded Files/Images</h3>
    <!-- <ul class="gallery"> -->
    <div class="row">
        <?php if(!empty($files))
        { 
            
            foreach($files as $file)
            { ?>
                <!-- <div class="row"> -->
                <div class="column">
                <div class="col-sm-3 card">
                    <img src="<?php echo ('http://localhost/codeigniter/uploads/files/'.$file['file_name']); ?>" alt="Avatar" style="width:100%">
                    <div class="container">
                        <h4><b>Uploaded On <?php echo date("j M Y",strtotime($file['uploaded_on'])); ?></b></h4> 
                        <p>Like Count <?php echo  $file['likes']?></p>
                        <p><a onclick="javascript:savelike(<?php echo $file['id'];?>);">
                            <i class="fa fa-thumbs-up">Like</i> </a>
                        </p>  
                        </p class="like_message"> </p> 
                    </div>
                </div>
                </div>
                
                <?php 
            } 
        }
        else
        { ?>
            <p>File(s) not found...</p>
            <?php 
        } ?>
        </div>
    </div>
    <!-- </ul> -->
    
    <?php
if(isset($get_data) && is_array($get_data) && count($get_data)): $i=1;
foreach ($get_data as $key => $data) { 
?>

<p><a onclick="javascript:savelike(<?php echo $data['id'];?>);">
     <i class="fa fa-thumbs-up">Like</i> 
     <span id="like_<?php echo $data['id'];?>">
        <?php if($data['likes']>0){echo $data['likes'].' Likes';}else{echo 'Like';} ?>
     </span></a>
    </p>   
    
<?php } endif; ?>
    
</div>


<script type="text/javascript">
function savelike(storyid)
{
        $.ajax({
                type: "POST",
                url: "<?php echo base_url('Upload_files/savelikes');?>",
                data: "Storyid="+storyid,
                dataType: 'json',
                
                
                success: function (response) {
                    location.reload();
                    $("p").append("<b>"+response+"</b>");
                }
            });
}
</script>

</body>
</html>
