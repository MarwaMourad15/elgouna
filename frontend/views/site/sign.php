<?php
/**
 * Created by PhpStorm.
 * User: marwa
 * Date: 22/09/16
 * Time: 01:29 م
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\User;

$this->title = 'Sign up';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-tittle">
    <div class="container">
        <div class="row">
            <h2>Sign up</h2>
        </div>
    </div>
</div>

<div>
    <div class="container">
      <div class="row">
          <div class="col-xs-12">

                  <?php $form = ActiveForm::begin(['options'=>['class'=>'sign-up']]); ?>
              <div class="row">
                  <div class="col-xs-3"></div>
                  <div class="col-xs-6">
                  <?php
                  if((isset($model->errors) && count($model->errors)>0) || ($error!=''))
                  {
                      echo '<div class="alert alert-danger">';
                      foreach ($model->errors as $key=>$value) {
                          echo '<span><b>'.$key.': </b></span>'.$value[0].' <br />';
                      }
                        echo $error;
                      echo'</div>';
                  }
                  ?>
                      </div>
              </div>
                  <div class="row">
                      <div class="col-xs-3">
                          <label>First Name(*):</label>
                      </div>
                      <div class="col-xs-9">
                          <input type="text" placeholder="First Name" id="first_name" name="User[first_name]" required="true">
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-xs-3">
                          <label>Last Name(*):</label>
                      </div>
                      <div class="col-xs-9">
                          <input type="text" placeholder="Last Name" id="last_name" name="User[last_name]" required="true">
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-xs-3">
                          <label>Your E-Mail(*):</label>
                      </div>
                      <div class="col-xs-9">
                          <input type="email" id="email" name="User[email]" placeholder="Your E-Mail" required="true">
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-xs-3">
                          <label>Your Password(*):</label>
                      </div>
                      <div class="col-xs-9">
                          <input type="password" id="password" name="User[password]" placeholder="Your Password" required="true">
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-xs-3">
                          <label>Confirm Password(*):</label>
                      </div>
                      <div class="col-xs-9">
                          <input type="password" id="repassword" name="User[repassword]" placeholder="Repeat Password" required="true">
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-xs-3">
                          <label>Mobile:</label>
                      </div>
                      <div class="col-xs-9">
                          <input type="text" name="User[mobile]" id="mobile" placeholder="Mobile">
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-xs-3">
                          <label>Office Phone:</label>
                      </div>
                      <div class="col-xs-9">
                          <input type="text" placeholder="Office Phone" id="office_phone" name="User[office_phone]">
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-xs-3">
                          <label>Fax:</label>
                      </div>
                      <div class="col-xs-9">
                          <input type="text" placeholder="Fax" id="fax" name="User[fax]">
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-xs-3">
                          <label>Account:</label>
                      </div>
                      <div class="col-xs-9">
                          <select name="User[account_id]" id="account_id" onchange="get_other_fields(this.value)">
                              <?php
                              foreach ($accounts as $account) {

                                  echo '<option value="'.$account['accountid'].'">'.$account['accountname'].'</option>';
                              }
                              ?>
                              <option value="0">Other</option>
                          </select>
                      </div>
                  </div>

                  <div id="other_account" style="display: none">
                      <div class="row">
                          <div class="col-xs-3">
                              <label>Account Name:</label>
                          </div>
                          <div class="col-xs-9">
                              <input type="text" name="User[other_account_name]" id="other_account_name" placeholder="Account Name">
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-xs-3">
                              <label>Account Website:</label>
                          </div>
                          <div class="col-xs-9">
                              <input type="text" name="User[account_website]" id="account_website"  placeholder="Account Website">
                          </div>
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-xs-3">
                          <label>Title:</label>
                      </div>
                      <div class="col-xs-9">
                          <input type="text" placeholder="Title" name="User[title]" id="title">
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-xs-3">
                          <label>Interested:</label>
                      </div>
                      <div class="col-xs-9">
                          <select name="User[interest_id]" id="interest_id">
                          <?php
                          foreach ($interests as $interest) {
                              echo '<option value="'.$interest['interest_id'].'">'.$interest['interest'].'</option>';
                          }
                          ?>
                          </select>
                      </div>
                  </div>

                  <?php
                  if(isset($countries) && count($countries)>0)
                  {
                  ?>
                      <div class="row">
                          <div class="col-xs-3">
                              <label>Mailing-Country:</label>
                          </div>
                          <div class="col-xs-9">
                              <select name="User[mailing_country_id]" id="mailing_country_id">
                                  <?php
                                  foreach ($countries as $country) {
                                      echo '<option value="'.$country['country_id'].'">'.$country['country'].'</option>';
                                  }
                                  ?>
                              </select>
                          </div>
                      </div>
                  <?php
                  }?>

                  <div class="row">
                      <div class="col-xs-3">
                          <label>Mailing-City:</label>
                      </div>
                      <div class="col-xs-9">
                          <input type="text" placeholder="Mailing-City" id="mailing_city" name="User[mailing_city]">
                      </div>
                  </div>

                  <div class="row">
                      <div class="col-xs-3">
                          <label>Mailing-Address:</label>
                      </div>
                      <div class="col-xs-9">
                          <input type="text" name="User[mailing_address]" id="mailing_address" placeholder="Mailing-Address">
                      </div>
                  </div>


                  <div class="row">
                      <div class="col-xs-12">
                          <?= Html::submitButton('Sign Up') ?>
                      </div>
                  </div>
              <?php ActiveForm::end(); ?>
          </div>
      </div>
    </div>
</div>

<script>

    function get_other_fields(account_id)
    {
        if(account_id==0)
        {
            document.getElementById('other_account').style.display='block';
            document.getElementById('other_account_name').style.display='block';
            document.getElementById('account_website').style.display='block';
        }
        else
        {
            document.getElementById('other_account').style.display='none';
            document.getElementById('other_account_name').style.display='none';
            document.getElementById('account_website').style.display='none';
        }
    }
</script>