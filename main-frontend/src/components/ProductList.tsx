// ProductList.tsx
import React from 'react';

interface ProductListProps {
    products: { id: number; name: string }[];
}

const ProductList: React.FC<ProductListProps> = ({ products }) => {
    return (
        <div>
            <h2>Product List</h2>
            <ul>
                {products.map(product => (
                    <li key={product.id}>{product.name}</li>
                ))}
            </ul>
        </div>
    );
};

export default ProductList;
