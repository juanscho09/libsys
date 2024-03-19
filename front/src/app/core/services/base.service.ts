import {Injectable} from '@angular/core';
import {HttpErrorResponse, HttpHeaders} from '@angular/common/http';
import {Router} from '@angular/router';

import {environment} from '../../../environments/environment';
import {GeneralResponse} from '../../models/general-response.model';
import {throwError} from 'rxjs';


@Injectable()
export class BaseService {

    public _api = environment.api;
    public _headers = new HttpHeaders();

    constructor(public router: Router) {
        this._headers.set('Accept', 'application/json')
            .append('Access-Control-Allow-Origin', '*')
            .append('Content-type', 'application/x-www-form-urlencoded')
            .append('X-Requested-With', 'XMLHttpRequest');
    }

    public handleError(error: HttpErrorResponse | any): any {
        const response = new GeneralResponse();
        response.message = [];
        response.status = "fail";

        /*if (error.error.data) {
            response.message = error.error.data.message;

            if (error.error.data.httpCode === 401) {
                this.router.navigate(['']);
            }

            if (error.error.data.errors) {

                const arrayErrors = Object.keys(error.error.data.errors).map(i => error.error.data.errors[i]);
                for (const err of arrayErrors) {
                    response.data.push(err);
                }
            }
        }*/

        if (response.message === '') {
            response.message = 'Ocurrió un problema con la comunicación con el servidor. Verfique su conexion y vuelva a intentarlo.';
        }
        return throwError(response);
    }
}
