    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration {
        public function up()
        {
            Schema::create('tours', function (Blueprint $table) {
                $table->id();
                $table->string('title', 191);
                $table->text('description')->nullable();
                $table->decimal('price', 12, 2)->default(0);
                $table->string('location')->nullable();
                $table->string('image')->nullable(); // path
                $table->boolean('is_active')->default(true);
                $table->string('slug')->unique()->nullable(); // untuk SEO & routing
                $table->timestamps();
            });
        }
        public function down()
        {
            Schema::dropIfExists('tours');
        }
    };
