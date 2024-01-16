// SplitwiseContainer.tsx
import React, { useState } from 'react';
import User from 'components/User';
import UserList from 'components/UserList';
import ProductList from 'components/ProductList';

import 'style/SplitwiseContainer.css';

interface UserProps {
    id: number;
    name: string;
}

interface ProductProps {
    id: number;
    name: string;
}

interface SplitwiseContainerProps {
    users: UserProps[];
    products: ProductProps[];
}

const SplitwiseContainer: React.FC<SplitwiseContainerProps> = ({ users, products }) => {
    const [selectedProducts, setSelectedProducts] = useState<{ [userId: number]: number[] }>({});

    const handleProductChange = (userId: number, productIds: number[]) => {
        setSelectedProducts((prevSelectedProducts) => ({
            ...prevSelectedProducts,
            [userId]: productIds,
        }));
    };

    const handleShowState = () => {
        console.log('Current State:', selectedProducts);
    };

    return (
        <div className="splitwise-container">
            <h1>Splitwise App</h1>
            <div className="lists-container">
                <UserList users={users} />
                <ProductList products={products} />
            </div>
            <div className="user-products-container">
                {users.map((user) => (
                    <User
                        key={user.id}
                        user={user}
                        products={products}
                        selectedProducts={selectedProducts[user.id] || []}
                        onProductChange={handleProductChange}
                    />
                ))}
            </div>
            <button onClick={handleShowState}>Show State</button>
        </div>
    );
};

export default SplitwiseContainer;
