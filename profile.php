<?php
session_start();
error_reporting(0);
include('config.php');
include('conn.php');

if(isset($_POST['contactadd'])){
    
    $type=$_POST['type'];
    $number=$_POST['number'];
    $query=mysqli_query($con,"insert into usercontacts(type,number,userid) values('$type','$number','".$_SESSION['id']."')");
    echo "<script>alert('Contact Added');</script>" ;
}

if(isset($_POST['contactcontact'])){
    
    $type=$_POST['type'];
    $number=$_POST['address'];
    $pincode=$_POST['pincode'];
    $query=mysqli_query($con,"insert into useaddress(type,address,picode,userid) values('$type','$number','$pincode','".$_SESSION['id']."')");
    echo "<script>alert('Contact Address Added');</script>" ;
}


    if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else
{



?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('head.php'); ?>
        <link rel="stylesheet" href="css/profile.css">
    </head>
    <body>



<?php include('header.php') ?>











        <!--=====================================
                    BANNER PART START
        =======================================-->
         <?php 
$query=mysqli_query($con,"select * from breadcrumbanner where id=1");
if($row=mysqli_fetch_array($query))
{
  


?>

        <section class="inner-section single-banner" style="background: url(admin/breadcrumbanner/<?php echo htmlentities
        ($row['image']) ?>) no-repeat center;">
        <?php } ?>
            <div class="container">
                <h2>Profile</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="product-details.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </div>
        </section>
        <!--=====================================
                    BANNER PART END
        =======================================-->











<?php
$sql1=mysqli_query($con,"select *  from user where id='".$_SESSION['id']."'");
             $results1=mysqli_fetch_array($sql1);
             $name=$results1['name'];
             $email=$results1['email'];
             $image=$results1['image'];



?>

        <!--=====================================
                    PROFILE PART START
        =======================================-->
        <section class="inner-section profile-part">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="account-card">
                            <div class="account-title">
                                <h4>Your Profile</h4>
                                <button data-bs-toggle="modal" data-bs-target="#profile-edit">edit profile</button>
                            </div>
                            <div class="account-content">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="profile-image">
                                            <a href="#"><img src="admin/user/user.png" alt="user"></a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">name</label>
                                            <input class="form-control" type="text" value="<?php echo $name; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Email</label>
                                            <input class="form-control" type="email" value="<?php echo $email; ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="profile-btn">
                                            <a href="change-password.php">change pass.</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="account-card">
                            <div class="account-title">
                                <h4>contact number</h4>
                                <button data-bs-toggle="modal" data-bs-target="#contact-add">add contact</button>
                            </div>
                            <div class="account-content">
                                <div class="row">
    <?php $sql=mysqli_query($con,"select *  from usercontacts where userid='".$_SESSION['id']."' order by type asc ");
             while($row=mysqli_fetch_array($sql)){
 ?>                                
                                    <div class="col-md-6 col-lg-4 alert fade show">
                                        <div class="profile-card contact <?php if($row['type']=='primary'||$row['Primary']){echo 'active';}else{} ?>">
                                            <h6><?php echo $row['type']; ?></h6>
                                            <p><?php echo $row['number']; ?></p>
                                            <ul>
                                                <li><button class="edit icofont-edit" title="Edit This" data-bs-toggle="modal" data-bs-target="#contact-edit<?php echo $row['id']; ?>"></button></li>
                                                <li><a href="profile.php?userid=<?php echo $_SESSION['id']; ?>&id=<?php echo $row['id']; ?>&removecontact=removecontact" class="trash icofont-ui-delete" title="Remove This" ></a></li>
                                            </ul>
                                        </div>
                                    </div>
                             <?php } ?>       
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="col-lg-12">
                        <div class="account-card">
                            <div class="account-title">
                                <h4>delivery address</h4>
                                <button data-bs-toggle="modal" data-bs-target="#address-add">add address</button>
                            </div>
                            <div class="account-content">
                                <div class="row">
    <?php $sql=mysqli_query($con,"select *  from useaddress where userid='".$_SESSION['id']."' order by type asc ");
             while($row=mysqli_fetch_array($sql)){
 ?>                                
                                    
                                    <div class="col-md-6 col-lg-4 alert fade show">
                                        <div class="profile-card address <?php if($row['type']=='home'){echo 'active';}else{} ?>">
                                            <h6><?php echo $row['type']; ?></h6>
                                            <p><?php echo $row['address']; echo " "; ?> <?php echo $row['picode']; ?></p>
                                            <ul class="user-action">
                                                <li><button class="edit icofont-edit" title="Edit This" data-bs-toggle="modal" data-bs-target="#address-edit<?php echo $row['id']; ?>"></button></li>
                                                <li><a href="profile.php?userid=<?php echo $_SESSION['id']; ?>&id=<?php echo $row['id']; ?>&removeaddress=removeaddress" class="trash icofont-ui-delete" title="Remove This" ></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </section>
        <!--=====================================
                    PROFILE PART END
        =======================================-->


        <!--=====================================
                    MODAL ADD FORM START
        =======================================-->
        <!-- contact add form -->
        <div class="modal fade" id="contact-add">
            <div class="modal-dialog modal-dialog-centered"> 
                <div class="modal-content">
                    <button class="modal-close" data-bs-dismiss="modal"><i class="icofont-close"></i></button>
                    <form class="modal-form" method="post">
                        <div class="form-title">
                            <h3>add new contact</h3>
                        </div>
                        <div class="form-group" >
                            <label class="form-label">Type</label>
                            <select class="form-select" name="type">
                                <option selected>choose type</option>
                                <option value="primary">primary</option>
                                <option value="secondary">secondary</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">number</label>
                            <input class="form-control" name="number" type="tel" placeholder="Enter your number">
                        </div>
                        <button class="form-btn" name="contactadd" type="submit">save contact info</button>
                    </form>
                </div> 
            </div> 
        </div>

        <!-- address add form -->
        <div class="modal fade" id="address-add">
            <div class="modal-dialog modal-dialog-centered"> 
                <div class="modal-content">
                    <button class="modal-close" data-bs-dismiss="modal"><i class="icofont-close"></i></button>
                    <form class="modal-form" method="post">
                        <div class="form-title">
                            <h3>add new address</h3>
                        </div>
                        <div class="form-group">
                            <label class="form-label">type</label>
                            <select class="form-select" name="type">
                                <option selected>choose type</option>
                                <option value="home">home</option>
                                <option value="office">office</option>
                                <option value="bussiness">Bussiness</option>
                                <option value="academy">academy</option>
                                <option value="others">others</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Pincode</label>
                            <input class="form-control" name="pincode" type="number" placeholder="Enter your number">
                        </div>                        <div class="form-group">
                            <label class="form-label">address</label>
                            <textarea class="form-control" name="address" placeholder="Enter your address"></textarea>
                        </div>
                        <button class="form-btn" name="contactcontact" type="submit">save address info</button>
                    </form>
                </div> 
            </div> 
        </div>

        <!--=====================================
                    MODAL ADD FORM END
        =======================================-->

        
        <!--=====================================
                    MODAL EDIT FORM START
        =======================================-->
        <!-- profile edit form -->
        <div class="modal fade" id="profile-edit">
            <div class="modal-dialog modal-dialog-centered"> 
                <div class="modal-content">
                    <button class="modal-close" data-bs-dismiss="modal"><i class="icofont-close"></i></button>
                    <form class="modal-form" method="post">
                        <div class="form-title">
                            <h3>edit profile info</h3>
                        </div>
                        <div class="form-group">
                            <label class="form-label">name</label>
                            <input class="form-control" name="name" type="text" value="<?php echo $name; ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label">email</label>
                            <input class="form-control" name="email" type="text" value="<?php echo $email; ?>">
                        </div>
                        <button class="form-btn" name="personal" type="submit">save profile info</button>
                    </form>
                </div> 
            </div> 
        </div>

        <!-- contact edit form -->
            <?php $sql=mysqli_query($con,"select *  from usercontacts where userid='".$_SESSION['id']."'");
             while($row=mysqli_fetch_array($sql)){
 ?>                                

        <div class="modal fade" id="contact-edit<?php echo $row['id']; ?>">
            <div class="modal-dialog modal-dialog-centered"> 
                <div class="modal-content">
                    <button class="modal-close" data-bs-dismiss="modal"><i class="icofont-close"></i></button>
                    <form class="modal-form" method="post">
                        <div class="form-title">
                            <h3>edit contact info</h3>
                        </div>
                        <div class="form-group">
                            <label class="form-label">title</label>
                            <select name="type" class="form-select">
                                <option selected><?php echo $row['type'] ?></option>
                                <option value="<?php if( $row['type']=='primary'){echo 'secondary';}else{ echo 'primary';} ?>"><?php if( $row['type']=='primary'){echo 'secondary';}else{ echo 'primary';} ?></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">number</label>
                            <input class="form-control" type="tel" name="number" value="<?php echo $row['number'] ?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="number" name="id" hidden  value="<?php echo $row['id'] ?>">
                        </div>
                        <button class="form-btn" type="submit" name="phone" type="submit">save contact info</button>
                    </form>
                </div> 
            </div> 
        </div>
        <?php } ?>

        <!-- address edit form -->
            <?php $sql=mysqli_query($con,"select *  from useaddress where userid='".$_SESSION['id']."'");
             while($row=mysqli_fetch_array($sql)){
 ?>                                
        
        <div class="modal fade" id="address-edit<?php echo $row['id']; ?>">
            <div class="modal-dialog modal-dialog-centered"> 
                <div class="modal-content">
                    <button class="modal-close" data-bs-dismiss="modal"><i class="icofont-close"></i></button>
                    <form class="modal-form" method="post">
                        <div class="form-title">
                            <h3>edit address info</h3>
                        </div>
                        <div class="form-group">
                            <label class="form-label">title</label>
                            <select name="type" class="form-select">
                                <option selected><?php echo $row['type'] ?></option>
                                <option value="home">home</option>
                                <option value="office">office</option>
                                <option value="bussiness">Bussiness</option>
                                <option value="academy">academy</option>
                                <option value="others">others</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">pincode</label>
                            <input class="form-control" type="number" name="pincode" value="<?php echo $row['picode']; ?>">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="number" name="id" hidden  value="<?php echo $row['id'] ;?>">
                        </div>

                        <div class="form-group">
                            <label class="form-label">address</label>
                            <input class="form-control" name="addresss1" value="<?php echo $row['address']; ?>" >
                        </div>
                        <button class="form-btn" name="address" type="submit">save address info</button>
                    </form>
                </div> 
            </div> 
        </div>
        <?php } ?>
        <!--=====================================
                    MODAL EDIT FORM END
        =======================================-->















<?php include('footer.php') ?>
<div style="display:none;">
    <a href="https://informatika.politap.ac.id/gacor-bang/">Slot Mahjong</a>
    <a href="https://informatika.politap.ac.id/server-thailand/">Server Thailand</a>
    <a href="https://room-gacor.almatajer.online/">room gacor</a>
    <a href="https://www.mededuinfo.com/themes/">situs toto</a>
    <a href="https://martinaberto.co.id/link-slot/">slot gacor</a>
    <a href="http://www.fhycs.unju.edu.ar/sistema_comunicacion/uploads/bandartogel/">togel online</a>
    <a href="https://elearning.yuasathai.com/shionaga/">shionaga</a>
    <a href="https://shionaga.almatajer.online/">shionaga</a>
    rel="noopener"
</div>

    </body>
</html>


<?php } ?>



