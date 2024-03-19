import { Component, OnInit } from '@angular/core';
import { FormControl } from '@angular/forms';
import { Book } from 'src/app/models/book/book.model';
import { BookService } from 'src/app/providers/book/book.service';
import { PageEvent } from '@angular/material/paginator';
import { Router } from '@angular/router';
import { MatDialog } from '@angular/material/dialog';
import { ModalsComponent } from '../../modals/modals.component';
import { MatSnackBar, MatSnackBarHorizontalPosition, MatSnackBarVerticalPosition } from '@angular/material/snack-bar';
import { BookingCreateComponent } from '../../booking/booking-create/booking-create.component';

@Component({
  selector: 'app-book-list',
  templateUrl: './book-list.component.html',
  styleUrls: ['./book-list.component.scss']
})
export class BookListComponent implements OnInit {
  books:Book[] = [];
  sortingControl = new FormControl("");
  searchControl = new FormControl("");
  totalCount: number = 0;
  pageIndex: number = 0;
  pageSize: number = 5;
  horizontalPosition: MatSnackBarHorizontalPosition = 'center';
  verticalPosition: MatSnackBarVerticalPosition = 'bottom';
  durationInSeconds = 5;
  
  constructor(
    private bookService:BookService,
    private router: Router,
    public dialog: MatDialog,
    private _snackBar: MatSnackBar
  ){

  }
  
  ngOnInit(): void {
    this.get("", "", "");
    this.sortingControl.valueChanges.subscribe((val) => {
      if( val ){
        this.pageIndex = 0;
        this.pageSize = 5;
        let sorting = this.getSorting(val);
        this.get(sorting.sort, sorting.orderby, this.searchControl.value ?? "");
      }
    })
  }

  doSearch(){
    this.pageIndex = 0;
    this.pageSize = 5;
    let sorting = this.getSorting(this.sortingControl.value ?? "");
    this.get(sorting.sort, sorting.orderby, this.searchControl.value ?? "");
  }

  getSorting(value: string){
    let sort = "";
    let orderby = "";
    if( value != "" ){
        sort= value.split('-')[0];
        orderby = value.split('-')[1];
    }
    return {
      sort,
      orderby
    }
  }

  get(sort: string, orderby: string, search: string){
    this.bookService.getBooks(sort, orderby, search, (this.pageIndex + 1), this.pageSize).subscribe((response:any) => {
      this.books = response.body.message.data as Book[];
      this.totalCount = response.body.message.pagination.totalRows 
        ? Number(response.body.message.pagination.totalRows) 
        : 0;
    })
  }

  handlePageEvent(e: PageEvent){
    this.pageIndex = e.pageIndex;
    this.pageSize = e.pageSize;

    let sorting = this.getSorting(this.sortingControl.value ?? "");
    this.get(sorting.sort, sorting.orderby, this.searchControl.value ?? "");
  }

  bookCreate() {
    this.router.navigateByUrl('/dashboard/book/bookCreate');
  }

  openConfirmDialog(bookId: string): void {
    const dialogRef = this.dialog.open(ModalsComponent, {
      width: '350px',
      data: { message: '¿Estás seguro de que queres eliminar este elemento?' }
    });

    dialogRef.afterClosed().subscribe(result => {
      if (result) {
        this.bookService.deleteBook(bookId).subscribe(
          response => {
            console.log('borrado correctamente');
            this.openSnackBar();
            this.get("", "", "");
          }, 
          error =>{
            console.log('Error al borrar el elemento');
          });
        // Aquí se ejecuta la lógica para eliminar el elemento
        // Llamada a tu función de eliminación
      }
    });
  }

  openLoanBookDialog(book: Book){
    this.dialog.open(BookingCreateComponent, {
      data: { data: book }
    });
  }

  openSnackBar(){
    this._snackBar.open('Se eliminó correctamente!!', 'OK', {
      horizontalPosition: this.horizontalPosition,
      verticalPosition: this.verticalPosition,
      duration: this.durationInSeconds * 3000,
    });
  }

}
