import { Injectable } from '@nestjs/common';
import { InjectRepository } from '@nestjs/typeorm';
import { Repository } from 'typeorm';
import { Seeder, DataFactory } from 'nestjs-seeder';
import { Product } from './entities/product.entity';
import { Category } from '../categories/entities/category.entity';

@Injectable()
export class ProductsSeeder implements Seeder {
  constructor(
    @InjectRepository(Product)
    private readonly productRepository: Repository<Product>,
    @InjectRepository(Category)
    private readonly categoryRepository: Repository<Category>,
  ) {}

  async seed(): Promise<any> {
    const categories = await this.categoryRepository.find();
    const products = DataFactory.createForClass(Product).generate(20);

    for (const product of products) {
      if (categories.length > 0) {
        const randomCategory =
          categories[Math.floor(Math.random() * categories.length)];
        (product as any).category = randomCategory;
      }
    }

    return this.productRepository.save(products);
  }

  async drop(): Promise<any> {
    return this.productRepository.delete({});
  }
}
