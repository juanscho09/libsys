import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/providers/auth/auth.service';
import { LoginRequest } from 'src/app/models/auth/auth.model';
import { FormControl, FormGroup, Validators, ReactiveFormsModule } from '@angular/forms';

@Component({
  selector: 'app-auth',
  templateUrl: './auth.component.html',
  styleUrls: ['./auth.component.scss']
})
export class AuthComponent {
  loginRequest: LoginRequest = {
    email: "",
    password: ""
  };
  loginForm = new FormGroup({
    email : new FormControl('',[Validators.required, Validators.email]),
    password: new FormControl('',[Validators.required, Validators.minLength(6)])
  });
  hide:boolean = true; 
  isLoading = false;
  
  constructor( 
    private router: Router,
    private authService: AuthService
  ) {}
  

  onFormSubmit(){
    if( this.loginForm.valid ){
      let valueFrom: any = this.loginForm.value;
      const loginRequestModel: LoginRequest = {
        email: valueFrom.email,
        password: valueFrom.password
      }
      this.login(loginRequestModel);
    }
  }

  login(data: LoginRequest) {
    this.isLoading = true;
    this.authService.login(data).subscribe(
      response => {
        this.authService.setToken(response.message.access_token);
        this.router.navigateByUrl('/dashboard/book/books');
        this.isLoading = false;
      },
      error => {
        console.log("No autorizado");
        this.isLoading = false;
      }
    );
  }
}
