import { Injectable } from '@nestjs/common';
import { InjectRepository } from '@nestjs/typeorm';
import { Repository } from 'typeorm';
import { Seeder, DataFactory } from 'nestjs-seeder';
import { Category } from './entities/category.entity';

@Injectable()
export class CategoriesSeeder implements Seeder {
  constructor(
    @InjectRepository(Category)
    private readonly categoryRepository: Repository<Category>,
  ) {}

  async seed(): Promise<any> {
    const categories = DataFactory.createForClass(Category).generate(5);
    return this.categoryRepository.save(categories);
  }

  async drop(): Promise<any> {
    return this.categoryRepository.delete({});
  }
}
