import { Column, Entity, ManyToOne, PrimaryGeneratedColumn } from 'typeorm';
import { Factory } from 'nestjs-seeder';
import { Category } from '../../categories/entities/category.entity';

@Entity({ name: 'products' })
export class Product {
  @PrimaryGeneratedColumn()
  id: number;

  @Factory((faker) => faker!.commerce.productName())
  @Column()
  name: string;

  @Factory((faker) => faker!.commerce.productDescription())
  @Column({ nullable: true })
  description: string;

  @Factory((faker) => parseFloat(faker!.commerce.price({ min: 1, max: 1000 })))
  @Column('decimal', { precision: 10, scale: 2, default: 0 })
  price: number;

  @ManyToOne(() => Category, (category) => category.products, {
    onDelete: 'SET NULL',
    nullable: true,
  })
  category: Category;
}
