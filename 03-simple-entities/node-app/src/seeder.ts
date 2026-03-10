import { seeder } from 'nestjs-seeder';
import { TypeOrmModule } from '@nestjs/typeorm';
import { Category } from './categories/entities/category.entity';
import { Product } from './products/entities/product.entity';
import { CategoriesSeeder } from './categories/categories.seeder';
import { ProductsSeeder } from './products/products.seeder';

seeder({
  imports: [
    TypeOrmModule.forRoot({
      type: 'postgres',
      host: 'localhost',
      port: 5433,
      username: 'pguser',
      password: 'password',
      database: 'nestjs',
      entities: [Category, Product],
      synchronize: true,
    }),
    TypeOrmModule.forFeature([Category, Product]),
  ],
}).run([CategoriesSeeder, ProductsSeeder]);
