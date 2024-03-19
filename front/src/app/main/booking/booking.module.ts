import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { BookingCreateComponent } from './booking-create/booking-create.component';
import { BookingEditComponent } from './booking-edit/booking-edit.component';
import { BookingListComponent } from './booking-list/booking-list.component';

import {MatTableModule} from '@angular/material/table';
import {MatInputModule} from '@angular/material/input';
import {MatPaginatorModule} from '@angular/material/paginator';
import {MatSort, MatSortModule} from '@angular/material/sort';
import {MatFormFieldModule} from '@angular/material/form-field';
import { BookingRoutingModule } from './booking-routing.module';
import { MatDialogModule } from '@angular/material/dialog';
import { MatButtonModule } from '@angular/material/button';
import { ReactiveFormsModule } from '@angular/forms';
import { BookLoanComponent } from './book-loan/book-loan.component';
import { MatSelectModule } from '@angular/material/select';
import { MatIconModule } from '@angular/material/icon';
import { MatSnackBarModule } from '@angular/material/snack-bar';
import { MatProgressSpinnerModule } from '@angular/material/progress-spinner';

@NgModule({
  declarations: [
    BookingCreateComponent,
    BookingEditComponent,
    BookingListComponent,
    BookLoanComponent
  ],
  imports: [
    CommonModule,
    CommonModule,
    MatTableModule,
    BookingRoutingModule,
    MatFormFieldModule, 
    MatInputModule, 
    MatSortModule, 
    MatPaginatorModule,
    MatDialogModule,
    MatButtonModule,
    ReactiveFormsModule,
    MatSelectModule,
    MatIconModule,
    MatSnackBarModule,
    MatProgressSpinnerModule
  ]
})
export class BookingModule { }
