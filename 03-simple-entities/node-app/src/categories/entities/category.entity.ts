import { Column, Entity, OneToMany, PrimaryGeneratedColumn } from 'typeorm';
import { Factory } from 'nestjs-seeder';
import { Product } from '../../products/entities/product.entity';

@Entity({ name: 'categories' })
export class Category {
  @PrimaryGeneratedColumn()
  id: number;

  @Factory((faker) => faker!.commerce.department())
  @Column()
  name: string;

  @Factory((faker) => faker!.commerce.productAdjective() + ' category')
  @Column({ nullable: true })
  description: string;

  @OneToMany(() => Product, (product) => product.category)
  products: Product[];
}
