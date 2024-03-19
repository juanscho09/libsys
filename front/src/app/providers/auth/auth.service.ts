import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Book } from '../../models/book/book.model';
import { GeneralResponse } from 'src/app/models/general-response.model';
import {catchError, map} from 'rxjs/operators';
import { LoginRequest } from 'src/app/models/auth/auth.model';
import { BaseService } from 'src/app/core/services/base.service';
import { Router } from '@angular/router';

@Injectable({
  providedIn: 'root'
})
export class AuthService extends BaseService {

    constructor(
        public override router: Router,
        private httpClient:HttpClient
    ) { 
        super(router);
    }

    login(login: LoginRequest): Observable<any> {
        const url = `${this._api}login`;
        return this.httpClient.post<GeneralResponse>(url, login)
          .pipe(
            map(res => {
              return new GeneralResponse(res.message, res.status, res.code);
            }),
            catchError(err => {
              return this.handleError(err);
            })
        );
    }

    logout(): Observable<any> {
        const url = `${this._api}logout`;
        return this.httpClient.delete<GeneralResponse>(url)
          .pipe(
            map(res => {
              return new GeneralResponse(res.message, res.status, res.code);
            }),
            catchError(err => {
              return this.handleError(err);
            })
        );
    }

    setToken(token: string) {
        localStorage.setItem('token', token);
    }
    
    getToken() {
        return localStorage.getItem('token');
    }

    deleteToken() {
        localStorage.removeItem('token');
    }

    isLoggedIn() {
        return !!this.getToken();
    }

}
