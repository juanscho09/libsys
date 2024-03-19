import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Observable, map } from 'rxjs';
import { User } from '../../models/user/user.model';
import { BaseService } from 'src/app/core/services/base.service';
import { Router } from '@angular/router';
import { GeneralResponse } from 'src/app/models/general-response.model';

@Injectable({
  providedIn: 'root'
})
export class UserService extends BaseService {

  constructor(
    public override router: Router,
    private httpClient:HttpClient
  ) {
    super(router)
   }

  saveUser(user: any, userId: string): Observable<{} | GeneralResponse> {
    const url = `${this._api}users/${userId}`;
    return this.httpClient.put<GeneralResponse>(url, user)
      .pipe(
        map(res => {
          //return new GeneralResponse('', res.error, false, null);
          return  new GeneralResponse(res.message, res.status, res.code);
        })
      );
  }

  storeUser(user: User): Observable<{} | GeneralResponse> {
    const url = `${this._api}users`;
    return this.httpClient.post<GeneralResponse>(url, user)
      .pipe(
        map(res => {
          //return new GeneralResponse('', res.error, false, null);
          return  new GeneralResponse(res.message, res.status, res.code);
        })
      );
  }

  getUsers(sort: string, orderby: string, search: string,
    currentPage: number, pageSize: number): Observable<HttpResponse<any>> {
    let url = `${this._api}users?page=${currentPage}&limit=${pageSize}`;
    if( sort && orderby ){
      url = `${url}&sort=${sort}&orderby=${orderby}`
    }

    if( search ){
      url = `${url}&search=${search}`;
    }
    return this.httpClient.get<HttpResponse<any>>(url, {observe: "response"});
  }

  /*updateBook(book: Book, bookId: string): Observable<{} | GeneralResponse> {
    const url = `${this._api}books/${bookId}`;
    return this.httpClient.put<GeneralResponse>(url, book)
      .pipe(
        map(res => {
          //return new GeneralResponse('', res.error, false, null);
          return  new GeneralResponse("", "", "");
        })
      );
  }*/

  deleteUser(userId: string): Observable<{} | GeneralResponse> {
    const url = `${this._api}users/${userId}`;
    return this.httpClient.delete<GeneralResponse>(url)
      .pipe(
        map(res => {
          //return new GeneralResponse('', res.error, false, null);
          return  new GeneralResponse("", "", "");
        })
      );
  }
}
