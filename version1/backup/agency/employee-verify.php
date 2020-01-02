<?php
require ('../header.php');

?>

<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Edit Employee</legend>

<!-- Appended checkbox -->
<div class="form-group">
  <label class="col-md-4 control-label" for="activeEmployee">Active Employee</label>
  <div class="col-md-4">
    <div class="input-group">
      <input id="activeEmployee" name="activeEmployee" class="form-control" type="text" placeholder="Is employee active?">
	        <span class="input-group-addon">     
          <input type="checkbox">     
      </span>
    </div>
    
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="employeeCategory">Employee Category</label>
  <div class="col-md-4">
    <select id="employeeCategory" name="employeeCategory" class="form-control">
      <option value="Administrator">Administrator</option>
      <option value="Case Coordinator">Case Coordinator</option>
      <option value="Intake Specialist">Intake Specialist</option>
      <option value="Nurse">Nurse</option>
      <option value="Physician">Physician</option>
      <option value="Program Specialist">Program Specialist</option>
      <option value="Psychologist">Psychologist</option>
      <option value="Social Worker- BS">Social Worker- BS</option>
      <option value="Social Worker- MSW">Social Worker- MSW</option>
      <option value="Support Service Personnel">Support Service Personnel</option>
      <option value="Targeted Case Manager">Targeted Case Manager</option>
      <option value="Therapist">Therapist</option>
      <option value="Unit Director">Unit Director</option>
    </select>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="emailAddress">Email</label>  
  <div class="col-md-4">
  <input id="emailAddress" name="emailAddress" type="text" placeholder="Email" class="form-control input-md" required="">
  <span class="help-block">Employee email</span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="firstName">First Name</label>  
  <div class="col-md-4">
  <input id="firstName" name="firstName" type="text" placeholder="Firstname" class="form-control input-md" required="">
  <span class="help-block">Employee's First Name</span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="lastName">Last Name</label>  
  <div class="col-md-4">
  <input id="lastName" name="lastName" type="text" placeholder="Last Name" class="form-control input-md" required="">
  <span class="help-block">Employee's Last Name</span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="EmployeeID">Employee ID</label>  
  <div class="col-md-4">
  <input id="EmployeeID" name="EmployeeID" type="text" placeholder="Employee ID" class="form-control input-md">
  <span class="help-block">Enter the employee's ID</span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Location">Location Code</label>  
  <div class="col-md-4">
  <input id="Location" name="Location" type="text" placeholder="Location Code" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-4">
    <button id="submit" name="submit" class="btn btn-primary">Submit</button>
  </div>
</div>

</fieldset>
</form>

</body>
</html>
