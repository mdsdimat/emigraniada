// User.tsx
import React from 'react';

interface UserProps {
    user: { id: number; name: string };
    products: { id: number; name: string }[];
    selectedProducts: number[];
    onProductChange: (userId: number, productIds: number[]) => void;
}

const User: React.FC<UserProps> = ({ user, products, selectedProducts, onProductChange }) => {
    const handleCheckboxChange = (productId: number) => {
        const updatedProducts = selectedProducts.includes(productId)
            ? selectedProducts.filter(id => id !== productId)
            : [...selectedProducts, productId];

        onProductChange(user.id, updatedProducts);
    };

    return (
        <div>
            <h3>{user.name}</h3>
            <label>Select Product(s):</label>
            {products.map(product => (
                <div key={product.id}>
                    <input
                        type="checkbox"
                        id={`user-${user.id}-product-${product.id}`}
                        checked={selectedProducts.includes(product.id)}
                        onChange={() => handleCheckboxChange(product.id)}
                    />
                    <label htmlFor={`user-${user.id}-product-${product.id}`}>{product.name}</label>
                </div>
            ))}
        </div>
    );
};

export default User;
