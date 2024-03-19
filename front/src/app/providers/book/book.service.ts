import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Book } from '../../models/book/book.model';
import { GeneralResponse } from 'src/app/models/general-response.model';
import {catchError, map} from 'rxjs/operators';
import { BaseService } from 'src/app/core/services/base.service';
import { Router } from '@angular/router';

@Injectable({
  providedIn: 'root'
})
export class BookService extends BaseService {

  constructor(
      public override router:Router,
      private httpClient:HttpClient
  ) {
    super(router);
   }

  //getBooks(sort: string, orderby: string, search: string): Observable<Book[]> {
  getBooks(sort: string, orderby: string, search: string,
    currentPage: number, pageSize: number): Observable<HttpResponse<any>> {
      let url = `${this._api}books?page=${currentPage}&limit=${pageSize}`;
      if( sort && orderby ){
        url = `${url}&sort=${sort}&orderby=${orderby}`
      }

      if( search ){
        url = `${url}&search=${search}`;
      }
      return this.httpClient.get<HttpResponse<any>>(url, {observe: "response"});
  }

  getBook(bookId: string): Observable<any> {
    const url = `${this._api}books/${bookId}/show`;
        return this.httpClient.get<GeneralResponse>(url)
          .pipe(
            map(res => {
              return new GeneralResponse(res.message, res.status, res.code);
            }),
            catchError(err => {
              return this.handleError(err);
            })
        );
  }

  storeBook(book: Book): Observable<{} | GeneralResponse> {
    const url = `${this._api}books`;
    return this.httpClient.post<GeneralResponse>(url, book)
      .pipe(
        map(res => {
          //return new GeneralResponse('', res.error, false, null);
          return  new GeneralResponse("", "", "");
        })
      );
  }

  updateBook(book: Book, bookId: string): Observable<{} | GeneralResponse> {
    const url = `${this._api}books/${bookId}`;
    return this.httpClient.put<GeneralResponse>(url, book)
      .pipe(
        map(res => {
          //return new GeneralResponse('', res.error, false, null);
          return  new GeneralResponse("", "", "");
        })
      );
  }

  deleteBook(bookId: string): Observable<{} | GeneralResponse> {
    const url = `${this._api}books/${bookId}`;
    return this.httpClient.delete<GeneralResponse>(url)
      .pipe(
        map(res => {
          //return new GeneralResponse('', res.error, false, null);
          return  new GeneralResponse("", "", "");
        })
      );
  }

  verifyBook(bookId: string): Observable<{} | GeneralResponse> {
    const url = `${this._api}books/${bookId}/availability`;
    return this.httpClient.get<GeneralResponse>(url)
      .pipe(
        map(res => {
          //return new GeneralResponse('', res.error, false, null);
          return  new GeneralResponse(res.message, "", "");
        })
      );
  }

}
