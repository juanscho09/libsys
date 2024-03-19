import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { BookingCreateComponent } from './booking-create/booking-create.component';
import { BookingEditComponent } from './booking-edit/booking-edit.component';
import { BookingListComponent } from './booking-list/booking-list.component';
import { BookLoanComponent } from './book-loan/book-loan.component';

const routes: Routes = [
  { path:'bookings', component:BookingListComponent },
  { path:'bookingCreate', component:BookingCreateComponent },
  { path:'bookLoans', component:BookLoanComponent },
  { path:'bookingEdit/:id', component:BookingEditComponent }
];

@NgModule({
  declarations: [],
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class BookingRoutingModule { }
