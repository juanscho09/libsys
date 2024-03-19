<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use Carbon\Carbon;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = [
            [
                'title' => '1984',
                'category' => 'Fiction',
                'author' => 'George Orwell',
                'publication_date' => Carbon::createFromFormat('Y-m-d', '1949-06-08')->toDateTimeString(),
                'publisher' => 'Secker & Warburg',
                'cover_image' => 'https://mir-s3-cdn-cf.behance.net/project_modules/1400/a4557793312907.5e6139cf2b2b6.jpg',
                'summary' => 'En un mundo de vigilancia gubernamental omnipresente, Winston Smith desafía el control del Gran Hermano en una sociedad distópica donde el pensamiento independiente es un crimen.',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'One Hundred Years of Solitude',
                'category' => 'Magical Realism',
                'author' => 'Gabriel García Márquez',
                'publication_date' => Carbon::createFromFormat('Y-m-d', '1967-05-30')->toDateTimeString(),
                'publisher' => 'Editorial Sudamericana',
                'cover_image' => 'https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1327881361i/320.jpg',
                'summary' => 'La familia Buendía enfrenta generaciones de amor, tragedia y magia en el pueblo de Macondo, donde los sueños y la realidad se entrelazan en un cuento mágico sobre la vida.',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'The Lord of the Rings',
                'category' => 'Fantasy Epic',
                'author' => 'J.R.R. Tolkien',
                'publication_date' => Carbon::createFromFormat('Y-m-d', '1954-07-29')->toDateTimeString(),
                'publisher' => 'Allen & Unwin',
                'cover_image' => 'https://m.media-amazon.com/images/I/81i1-a1lq9L._AC_UF1000,1000_QL80_.jpg',
                'summary' => 'Frodo Baggins emprende un viaje épico para destruir un anillo mágico y salvar a la Tierra Media de la oscuridad, enfrentándose a poderosos enemigos y formando la Comunidad del Anillo.',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'Pride and Prejudice',
                'category' => 'Romantic Classic',
                'author' => 'Jane Austen',
                'publication_date' => Carbon::createFromFormat('Y-m-d', '1813-01-28')->toDateTimeString(),
                'publisher' => 'T. Egerton, Whitehall',
                'cover_image' => 'https://images.squarespace-cdn.com/content/v1/58c180edff7c50dd0e51a2ad/1596042032039-IN7LLXRVDKGVC854LVHE/9780241375273.jpg',
                'summary' => 'Elizabeth Bennet y el señor Darcy superan sus prejuicios sociales para encontrar el amor verdadero en la Inglaterra del siglo XIX, en una historia de orgullo, prejuicio y segundas oportunidades.',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'category' => 'Classic Fiction',
                'author' => 'Harper Lee',
                'publication_date' => Carbon::createFromFormat('Y-m-d', '1960-07-11')->toDateTimeString(),
                'publisher' => 'J. B. Lippincott & Co.',
                'cover_image' => 'https://media.glamour.com/photos/56e1f3c462b398fa64cbd304/master/w_1600%2Cc_limit/entertainment-2016-02-18-main.jpg',
                'summary' => 'En la Alabama de los años 30, Atticus Finch defiende la justicia y la igualdad racial al representar a un hombre negro acusado de violación, mientras su hija Scout observa el mundo con ojos inocentes.',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'Harry Potter and the Philosopher\'s Stone',
                'category' => 'Juvenile Fantasy',
                'author' => 'J.K. Rowling',
                'publication_date' => Carbon::createFromFormat('Y-m-d', '1997-06-26')->toDateTimeString(),
                'publisher' => 'Bloomsbury',
                'cover_image' => 'https://upload.wikimedia.org/wikipedia/en/6/6b/Harry_Potter_and_the_Philosopher%27s_Stone_Book_Cover.jpg',
                'summary' => 'Harry Potter, un niño huérfano, descubre su identidad como mago y asiste a Hogwarts, donde junto con sus amigos enfrenta desafíos mágicos mientras investigan la misteriosa desaparición de la Piedra Filosofal, todo mientras luchan contra el malvado Voldemort.',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'Don Quixote',
                'category' => 'Picaresque Novel',
                'author' => 'Miguel de Cervantes',
                'publication_date' => Carbon::createFromFormat('Y-m-d', '1605-01-16')->toDateTimeString(),
                'publisher' => 'Francisco de Robles',
                'cover_image' => 'https://ih1.redbubble.net/image.2540048392.7106/flat,750x,075,f-pad,750x1000,f8f8f8.u2.jpg',
                'summary' => 'El hidalgo Don Quijote y su leal escudero Sancho Panza emprenden aventuras cómicas y surrealistas en la España del siglo XVII, desafiando molinos de viento y buscando la gloria en un mundo de ilusiones.',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'The Hunger Games',
                'category' => 'Juvenile Science Fiction',
                'author' => 'Suzanne Collins',
                'publication_date' => Carbon::createFromFormat('Y-m-d', '2008-09-14')->toDateTimeString(),
                'publisher' => 'Scholastic Corporation',
                'cover_image' => 'https://m.media-amazon.com/images/I/71un2hI4mcL._AC_UF1000,1000_QL80_.jpg',
                'summary' => 'En un futuro distópico, Katniss Everdeen se ofrece como voluntaria para los Juegos del Hambre en lugar de su hermana. En la arena, lucha por su supervivencia mientras desafía al gobierno opresivo y se convierte en un símbolo de rebelión.',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'The Shadow of the Wind',
                'category' => 'Historical Novel',
                'author' => 'Carlos Ruiz Zafón',
                'publication_date' => Carbon::createFromFormat('Y-m-d', '2001-04-01')->toDateTimeString(),
                'publisher' => 'Editorial Planeta',
                'cover_image' => 'https://cdn.waterstones.com/bookjackets/large/9781/4746/9781474609883.jpg',
                'summary' => 'En la Barcelona de posguerra, Daniel Sempere se sumerge en la búsqueda del misterioso autor de un libro llamado "La Sombra del Viento", desatando una intrincada trama de secretos y conexiones en la ciudad. Con la ayuda de su amigo Fermín y su amor por Bea, Daniel descubre oscuros secretos familiares que amenazan con consumirlo.',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'The Little Prince',
                'category' => 'Philosophical Tale',
                'author' => 'Antoine de Saint-Exupéry',
                'publication_date' => Carbon::createFromFormat('Y-m-d', '1943-04-06')->toDateTimeString(),
                'publisher' => 'Reynal & Hitchcock',
                'cover_image' => 'https://m.media-amazon.com/images/I/71OZY035QKL._AC_UF1000,1000_QL80_.jpg',
                'summary' => 'Un piloto estrellado en el desierto conoce a un joven príncipe que viene de un asteroide lejano. A medida que el príncipe comparte sus experiencias en otros planetas, revela lecciones atemporales sobre la vida, el amor y la amistad.',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'El alquimista',
                'category' => 'Novela de aventuras',
                'author' => 'Paulo Coelho',
                'publication_date' => Carbon::createFromFormat('Y-m-d', '1988-01-01')->toDateTimeString(),
                'publisher' => 'HarperCollins',
                'cover_image' => 'https://contentv2.tap-commerce.com/cover/large/9789878435756_1.jpg?id_com=1156',
                'summary' => 'El pastor Santiago emprende un viaje en busca de su tesoro personal, aprendiendo lecciones sobre el destino, la sabiduría y el amor mientras atraviesa el desierto y sigue los signos del universo.',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'Rayuela',
                'category' => 'Novela experimental',
                'author' => 'Julio Cortázar',
                'publication_date' => Carbon::createFromFormat('Y-m-d', '1963-01-01')->toDateTimeString(),
                'publisher' => 'Editorial Sudamericana',
                'cover_image' => 'https://pitagoraslibreria.com.ar/wp-content/uploads/2021/07/41UfZV4MqfL.jpg',
                'summary' => 'Rayuela sigue las aventuras de Horacio Oliveira, quien busca el amor y la felicidad en París y Buenos Aires mientras se enfrenta a la alienación y la búsqueda de significado en un mundo absurdo y caótico.',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'Anna Karenina',
                'category' => 'Novela realista',
                'author' => 'León Tolstói',
                'publication_date' => Carbon::createFromFormat('Y-m-d', '1877-01-01')->toDateTimeString(),
                'publisher' => 'The Russian Messenger',
                'cover_image' => 'https://i.pinimg.com/474x/45/0a/7c/450a7c3ea4c18451c1c1e82d4d5d08d2.jpg',
                'summary' => 'Anna Karenina lucha contra las convenciones sociales y su pasión prohibida por el conde Vronski en la Rusia del siglo XIX, mientras su búsqueda de la felicidad la lleva al abismo del amor y la tragedia.',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'The Great Gatsby',
                'category' => 'Novela modernista',
                'author' => 'F. Scott Fitzgerald',
                'publication_date' => Carbon::createFromFormat('Y-m-d', '1925-01-01')->toDateTimeString(),
                'publisher' => 'Charles Scribner\'s Sons',
                'cover_image' => 'https://upload.wikimedia.org/wikipedia/commons/7/7a/The_Great_Gatsby_Cover_1925_Retouched.jpg',
                'summary' => 'Jay Gatsby persigue el sueño americano de riqueza y amor en la década de 1920, mientras se enfrenta a la corrupción y la vacuidad de la alta sociedad en una narrativa de lujo, decadencia y tragedia.',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'Chronicle of a Death Foretold',
                'category' => 'Magical Realism',
                'author' => 'Gabriel García Márquez',
                'publication_date' => Carbon::createFromFormat('Y-m-d', '1981-01-01')->toDateTimeString(),
                'publisher' => 'Editorial Sudamericana',
                'cover_image' => 'https://upload.wikimedia.org/wikipedia/en/5/50/ChronicleOfADeathForetold.JPG',
                'summary' => 'En un pueblo caribeño, el asesinato de Santiago Nasar se anuncia públicamente, pero nadie interviene para evitarlo, en una narrativa entrecruzada de amor, honor y fatalidad.',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'Crime and Punishment',
                'category' => 'Psychological Fiction',
                'author' => 'Fyodor Dostoevsky',
                'publication_date' => Carbon::createFromFormat('Y-m-d', '1866-01-01')->toDateTimeString(),
                'publisher' => 'The Russian Messenger',
                'cover_image' => 'https://d28hgpri8am2if.cloudfront.net/book_images/onix/cvr9781684122905/crime-and-punishment-9781684122905_hr.jpg',
                'summary' => 'Raskólnikov, un estudiante pobre y atormentado, comete un crimen teóricamente justificado para demostrar su superioridad, pero se ve atormentado por la culpa y el remordimiento en una exploración psicológica del pecado y la redención.',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'The Catcher in the Rye',
                'category' => 'Coming-of-age Fiction',
                'author' => 'J.D. Salinger',
                'publication_date' => Carbon::createFromFormat('Y-m-d', '1951-07-16')->toDateTimeString(),
                'publisher' => 'Little, Brown and Company',
                'cover_image' => 'https://target.scene7.com/is/image/Target/GUEST_229f3fe4-ab67-4589-ad8b-45b6378be7a6?wid=488&hei=488&fmt=pjpeg',
                'summary' => 'The Catcher in the Rye sigue a Holden Caulfield en su viaje por Nueva York después de ser expulsado de la escuela, explorando su lucha contra la hipocresía y la alienación mientras busca autenticidad y conexión en un mundo adulto que le parece falso',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'War and Peace',
                'category' => 'Historical Novel',
                'author' => 'León Tolstói',
                'publication_date' => Carbon::createFromFormat('Y-m-d', '1869-01-01')->toDateTimeString(),
                'publisher' => 'The Russian Messenger',
                'cover_image' => 'https://images.penguinrandomhouse.com/cover/9781101003831',
                'summary' => 'War and Peace narra las vidas entrelazadas de nobles rusos durante las guerras napoleónicas, explorando temas de amor, guerra y destino a través de personajes como Pierre Bezukhov, Andrei Bolkonsky y Natasha Rostova en un panorama épico de la historia rusa.',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'Moby-Dick; or, The Whale',
                'category' => 'Adventure Fiction',
                'author' => 'Herman Melville',
                'publication_date' => Carbon::createFromFormat('Y-m-d', '1851-10-18')->toDateTimeString(),
                'publisher' => 'Harper & Brothers',
                'cover_image' => 'https://images.booksense.com/images/954/105/9780143105954.jpg',
                'summary' => 'El capitán Ahab persigue obsesivamente a la ballena blanca Moby Dick en una búsqueda épica de venganza y redención en los mares del siglo XIX, en una historia sobre la obsesión, la ambición y la naturaleza humana.',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'Frankenstein; or, The Modern Prometheus',
                'category' => 'Gothic Fiction',
                'author' => 'Mary Shelley',
                'publication_date' => Carbon::createFromFormat('Y-m-d', '1818-01-01')->toDateTimeString(),
                'publisher' => 'Lackington, Hughes, Harding, Mavor & Jones',
                'cover_image' => 'https://m.media-amazon.com/images/I/71QXRqSbUAL._AC_UF1000,1000_QL80_.jpg',
                'summary' => 'Frankenstein cuenta la historia del científico Victor Frankenstein, quien crea un ser humano artificial. La criatura, rechazada por la sociedad, busca venganza contra su creador, desencadenando una tragedia que explora las consecuencias de la ambición desmedida y la alienación.',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'The Picture of Dorian Gray',
                'category' => 'Gothic Fiction',
                'author' => 'Oscar Wilde',
                'publication_date' => Carbon::createFromFormat('Y-m-d', '1890-07-01')->toDateTimeString(),
                'publisher' => 'Ward, Lock and Company',
                'cover_image' => 'https://m.media-amazon.com/images/I/81NHKbml+QL._AC_UF1000,1000_QL80_.jpg',
                'summary' => 'The Picture of Dorian Gray sigue la historia de un joven llamado Dorian Gray, quien intercambia su alma por la juventud eterna mientras su retrato envejece en su lugar. A medida que Dorian se sumerge en la decadencia y el hedonismo, el retrato refleja su verdadera naturaleza, desencadenando una espiral de corrupción moral y destrucción.',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'Les Misérables',
                'category' => 'Historical Novel',
                'author' => 'Victor Hugo',
                'publication_date' => Carbon::createFromFormat('Y-m-d', '1862-01-01')->toDateTimeString(),
                'publisher' => 'A. Lacroix, Verboeckhoven & Cie.',
                'cover_image' => 'https://d28hgpri8am2if.cloudfront.net/book_images/onix/cvr9781626864641/les-miserables-9781626864641_hr.jpg',
                'summary' => 'Jean Valjean lucha por redimirse después de ser liberado de prisión, mientras es perseguido por el implacable inspector Javert en la tumultuosa Francia del siglo XIX, en una épica historia de redención y sacrificio.',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'Brave New World',
                'category' => 'Dystopian Fiction',
                'author' => 'Aldous Huxley',
                'publication_date' => Carbon::createFromFormat('Y-m-d', '1932-01-01')->toDateTimeString(),
                'publisher' => 'Chatto & Windus',
                'cover_image' => 'https://i.pinimg.com/736x/ae/f4/e2/aef4e2296f78750e5daab650d47eec48.jpg',
                'summary' => 'En un futuro distópico, la sociedad está controlada y condicionada para mantener la estabilidad y la felicidad mediante el consumo de drogas y la supresión del pensamiento crítico. La historia sigue a Bernard Marx, un disidente en un mundo de conformidad, mientras cuestiona las normas y se enfrenta a las consecuencias de su rebelión.',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ],
            [
                'title' => 'The Brothers Karamazov',
                'category' => 'Philosophical Novel',
                'author' => 'Fyodor Dostoevsky',
                'publication_date' => Carbon::createFromFormat('Y-m-d', '1880-01-01')->toDateTimeString(),
                'publisher' => 'The Russian Messenger',
                'cover_image' => 'https://i.pinimg.com/originals/cc/2e/74/cc2e74f4722a44192016cc5148950739.jpg',
                'summary' => 'En la Rusia del siglo XIX, los hermanos Dmitri, Iván y Alexei Karamazov se enfrentan a sus propios conflictos morales y espirituales, mientras su padre, Fiódor, es asesinado en circunstancias misteriosas. A través de intrincadas relaciones familiares y debates filosóficos, la novela explora temas de fe, libre albedrío y redención en un contexto de pasión, culpa y búsqueda de significado.',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]
        ];

        foreach ($books as $book) {
            Book::create([
                'title' => $book['title'],
                'category' => $book['category'],
                'author' => $book['author'],
                'publication_date' => $book['publication_date'],
                'publisher' => $book['publisher'],
                'cover_image' => $book['cover_image'],
                'summary' => $book['summary'],
                'created_at' => $book['created_at'],
                'updated_at' => $book['updated_at']
            ]);
        }
    }

}
