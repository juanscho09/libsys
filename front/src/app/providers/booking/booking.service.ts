import { Injectable } from '@angular/core';
import { HttpClient, HttpResponse } from '@angular/common/http';
import {catchError, Observable, map } from 'rxjs';
import { BaseService } from 'src/app/core/services/base.service';
import { Router } from '@angular/router';
import { GeneralResponse } from 'src/app/models/general-response.model';

@Injectable({
  providedIn: 'root'
})
export class BookingService extends BaseService {

  constructor(
    public override router: Router,
    private httpClient:HttpClient
  ){
    super(router)
   }

  getPendingReservation(sort: string, orderby: string, search: string,
    currentPage: number, pageSize: number): Observable<HttpResponse<any>> {
      let url = `${this._api}bookings/pending-reservations?page=${currentPage}&limit=${pageSize}`;
      if( sort && orderby ){
        url = `${url}&sort=${sort}&orderby=${orderby}`
      }

      if( search ){
        url = `${url}&search=${search}`;
      }
      return this.httpClient.get<HttpResponse<any>>(url, {observe: "response"});
  }

  getLoans(sort: string, orderby: string, search: string,
    currentPage: number, pageSize: number): Observable<HttpResponse<any>> {
      let url = `${this._api}bookings/loans?page=${currentPage}&limit=${pageSize}`;
      if( sort && orderby ){
        url = `${url}&sort=${sort}&orderby=${orderby}`
      }

      if( search ){
        url = `${url}&search=${search}`;
      }
      return this.httpClient.get<HttpResponse<any>>(url, {observe: "response"});
  }

  storeLoan(data: any): Observable<{} | GeneralResponse> {
    const url = `${this._api}bookings/store-loan`;
    return this.httpClient.post<GeneralResponse>(url, data)
      .pipe(
        map(res => {
          //return new GeneralResponse('', res.error, false, null);
          return  new GeneralResponse(res.message, res.status, res.code);
        })
      );
  }

  storeBooking(data: any): Observable<{} | GeneralResponse>{
    const url = `${this._api}bookings/store-booking`;
    return this.httpClient.post<GeneralResponse>(url, data)
      .pipe(
        map(res => {
          //return new GeneralResponse('', res.error, false, null);
          return  new GeneralResponse(res.message, res.status, res.code);
        })
      );
  }

  returned(bookingId: string): Observable<{} | GeneralResponse> {
    const url = `${this._api}bookings/${bookingId}/returned`;
    return this.httpClient.put<GeneralResponse>(url, {})
      .pipe(
        map(res => {
          //return new GeneralResponse('', res.error, false, null);
          return  new GeneralResponse(res.message, res.status, res.code);
        }),
        catchError(err => {
          return this.handleError(err);
        })
      )
  }

  delete(bookingId: string): Observable<{} | GeneralResponse> {
    const url = `${this._api}bookings/${bookingId}`;
    return this.httpClient.delete<GeneralResponse>(url)
      .pipe(
        map(res => {
          //return new GeneralResponse('', res.error, false, null);
          return  new GeneralResponse("", "", "");
        }),
        catchError(err => {
          return this.handleError(err);
        })
      );
  }
}
