import { Component } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';
import { BookService } from 'src/app/providers/book/book.service';
import { Book } from 'src/app/models/book/book.model';
import { GeneralResponse } from 'src/app/models/general-response.model';

/*export const MY_DATE_FORMATS = {
  parse: {
    dateInput: 'DD/MM/YYYY',
  },
  display: {
    dateInput: 'DD/MM/YYYY',
    monthYearLabel: 'MMMM YYYY',
    dateA11yLabel: 'LL',
    monthYearA11yLabel: 'MMMM YYYY'
  },
};*/



@Component({
  selector: 'app-book-create',
  templateUrl: './book-create.component.html',
  providers: [
    
  ],
  styleUrls: ['./book-create.component.scss']
})
export class BookCreateComponent {
  

  bookForm: FormGroup;

  constructor(
    private _fb:FormBuilder,
    private bookService: BookService
  ){
    this.bookForm = this._fb.group({
      title: new FormControl('',[Validators.required]),
      author: new FormControl('',[Validators.required]),
      category: new FormControl('',[Validators.required]),
      publisher: new FormControl('',[Validators.required]),
      publication_date: new FormControl('',[Validators.required]),
      cover_image: new FormControl('',[Validators.required]),
      summary: new FormControl('',[Validators.required])
    })
  }

  onFormSubmit(){
    if( this.bookForm.valid ){
      let valueFrom: any = this.bookForm.value;
      const bookModel: Book = {
        id: valueFrom.id,
        title: valueFrom.title,
        author: valueFrom.author,
        category: valueFrom.category,
        publisher: valueFrom.publisher,
        publication_date: valueFrom.publication_date,
        cover_image: valueFrom.cover_image,
        summary: valueFrom.summary,
      }
      

      this.bookService.storeBook(bookModel).subscribe(
        (response: any) => {
          console.log(response.code);
          //return response.code;
          //this.router.navigate(['cotizador/confirmacion']);
          /*if (!response.code) {
            //localStorage.clear();
            //this.router.navigate(['cotizador/confirmacion']);
          } else {
            //this.toastr.error(response.message);
          }*/
        },(err) => {
          //this.toastr.error(err.message);
        }
      );

      console.log(bookModel.author);
    }
  }
}
