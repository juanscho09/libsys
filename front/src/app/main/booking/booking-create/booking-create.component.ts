import { Component, Inject } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { MAT_DIALOG_DATA, MatDialogRef } from '@angular/material/dialog';
import { MatSnackBar, MatSnackBarHorizontalPosition, MatSnackBarVerticalPosition } from '@angular/material/snack-bar';
import { Book } from 'src/app/models/book/book.model';
import { User } from 'src/app/models/user/user.model';
import { BookService } from 'src/app/providers/book/book.service';
import { BookingService } from 'src/app/providers/booking/booking.service';
import { UserService } from 'src/app/providers/user/user.service';

@Component({
  selector: 'app-booking-create',
  templateUrl: './booking-create.component.html',
  styleUrls: ['./booking-create.component.scss']
})
export class BookingCreateComponent {
  bookingForm: FormGroup;
  users: User[];
  createBooking = true;
  dataLoan: {};
  horizontalPosition: MatSnackBarHorizontalPosition = 'center';
  verticalPosition: MatSnackBarVerticalPosition = 'bottom';
  durationInSeconds = 5;
  
  constructor(
    private _fb:FormBuilder,
    private userService:UserService,
    private bookService:BookService,
    private bookingService:BookingService,
    private _snackBar: MatSnackBar,
    public dialogRef: MatDialogRef<BookingCreateComponent>,
    @Inject(MAT_DIALOG_DATA) public data: { data: Book }
  ){
    this.bookingForm = this._fb.group({
      user: [''],
      book: ''
    })
    this.verifyBook(this.data.data.id);
    this.getUsers();
  }

  verifyBook(bookId: string){
    this.bookService.verifyBook(bookId).subscribe(
      (resp:any) => {
        this.createBooking = resp.message;
        this.fillBookingForm();
      },
      error => {
        console.log("no se pudo verificar el libro");
      }
    );
  }

  fillBookingForm(){
    this.bookingForm.patchValue({
      book: this.data.data.title
    })
  }

  onFormSubmit(){
    if( this.bookingForm.valid ){
      console.log(this.bookingForm.value)
    }
  }

  getUsers(){
    this.userService.getUsers("", "", "", 1, 100000).subscribe((response:any) => {
      this.users = response.body.message.data as User[];
    })
  }

  cancelCreateBooking(){ 
  }

  saveLoanBook(){
    this.dataLoan = {
      book_id: this.data.data.id,
      user_id: this.bookingForm.get('user').value
    }
    this.bookingService.storeLoan(this.dataLoan).subscribe(
      (resp: any) => {
        this.openSnackBar(resp.message);
        this.dialogRef.close(true);
        console.log('se guardo correctamente');
      },
      (error: any) => {
        console.log('hubo un error al guardar el prestamo');
      }
    )
  }

  saveBooking(){
    this.dataLoan = {
      book_id: this.data.data.id,
      user_id: this.bookingForm.get('user').value
    }
    this.bookingService.storeBooking(this.dataLoan).subscribe(
      (resp: any) => {
        this.openSnackBar(resp.message);
        this.dialogRef.close(true);
        console.log('se guardo correctamente');
      },
      (error: any) => {
        console.log('hubo un error al guardar el prestamo');
      }
    )
  }

  openSnackBar(message: string){
    this._snackBar.open(message, 'OK', {
      horizontalPosition: this.horizontalPosition,
      verticalPosition: this.verticalPosition,
      duration: this.durationInSeconds * 3000,
    });
  }

}
