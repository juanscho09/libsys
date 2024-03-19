import { Component, Inject, OnInit } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';
import { MAT_DIALOG_DATA, MatDialogRef } from '@angular/material/dialog';
import { MatSnackBar, MatSnackBarHorizontalPosition, MatSnackBarVerticalPosition } from '@angular/material/snack-bar';
import { User } from 'src/app/models/user/user.model';
import { UserService } from 'src/app/providers/user/user.service';

@Component({
  selector: 'app-user-create',
  templateUrl: './user-create.component.html',
  styleUrls: ['./user-create.component.scss']
})
export class UserCreateComponent implements OnInit{
  userForm: FormGroup;
  isLoading = false;
  horizontalPosition: MatSnackBarHorizontalPosition = 'center';
  verticalPosition: MatSnackBarVerticalPosition = 'top';
  durationInSeconds = 5;
  showPassword = true;

  constructor(
    private _fb:FormBuilder,
    private userService: UserService,
    private _snackBar: MatSnackBar,
    public dialogRef: MatDialogRef<UserCreateComponent>,
    @Inject(MAT_DIALOG_DATA) public data:any
  ){
    this.userForm = this._fb.group({
      name: new FormControl('',[Validators.required]),
      lastname: new FormControl('',[Validators.required]),
      email: new FormControl('',[Validators.required, Validators.email]),
      password: new FormControl('',[Validators.required]),
      password_confirmation: new FormControl('',[Validators.required]),
    },
    { validator: this.passwordMatchValidator });
  }
  ngOnInit(): void {
    this.userForm.patchValue(this.data);
    if( this.data ){
      this.setFormSaveUser();
    }
  }

  setFormSaveUser(){
    this.userForm.get('password').clearValidators();
    this.userForm.get('password').updateValueAndValidity();
    this.userForm.get('password_confirmation').clearValidators();
    this.userForm.get('password_confirmation').updateValueAndValidity();
  }

  passwordMatchValidator(g: FormGroup) {
    return g.get('password').value === g.get('password_confirmation').value ? null : { 'mismatch': true };
  }

  onFormSubmit(){
    this.isLoading = true;
    if( this.userForm.valid ){
      if( this.data ){
        this.editUser();
      } else {
        this.createUser();
      }
      
    } else { this.isLoading = false; }
  }

  createUser(){
    let valueFrom: any = this.userForm.value;
    const userModel: User = {
          id: valueFrom.id,
        name: valueFrom.name,
        lastname: valueFrom.lastname,
        email: valueFrom.email,
        password: valueFrom.password,
        password_confirmation: valueFrom.password_confirmation,
    }
    
    this.userService.storeUser(userModel).subscribe(
      (response: any) => {
        console.log(response.code);
        this.dialogRef.close(true);
        this.isLoading = false;
      },
      (err) => {
        this.isLoading = false;
        //this.toastr.error(err.message);
      }
    );
  }

  editUser(){
    let valueFrom: any = this.userForm.value;
    const userModel: any = {
          id: valueFrom.id,
        name: valueFrom.name,
        lastname: valueFrom.lastname,
        email: valueFrom.email
    }
    
    this.userService.saveUser(userModel, this.data.id).subscribe(
      (response: any) => {
        console.log(response.code);
        this.dialogRef.close(true);
        this.isLoading = false;
      },
      (err) => {
        this.isLoading = false;
        //this.toastr.error(err.message);
      }
    );
  }

  openSnackBar(){
    this._snackBar.open('Se creó correctamente!!', 'OK', {
      horizontalPosition: this.horizontalPosition,
      verticalPosition: this.verticalPosition,
      duration: this.durationInSeconds * 3000,
    });
  }

  /*togglePasswordVisibility() {
    //this.showPassword = this.showPassword;
    const passwordControl = this.userForm.get('password');
    const confirmationPasswordControl = this.userForm.get('password_confirmation');
    
    // Si se oculta el campo de contraseña, quitar la validación
    if (!this.showPassword) {
      passwordControl.clearValidators();
      passwordControl.updateValueAndValidity();
      confirmationPasswordControl.clearValidators();
      confirmationPasswordControl.updateValueAndValidity();
    } else {
      passwordControl.setValidators(Validators.required);
      passwordControl.updateValueAndValidity();
      confirmationPasswordControl.setValidators(Validators.required);
      confirmationPasswordControl.setValidators(this.passwordMatchValidator);
      confirmationPasswordControl.updateValueAndValidity();
    }
  }*/


}
