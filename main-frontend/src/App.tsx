// App.tsx
import React from 'react';
import SplitwiseContainer from 'components/SplitwiseContainer';

const App: React.FC = () => {
    const users = [
        { id: 1, name: 'User 1' },
        { id: 2, name: 'User 2' },
        // Add more users as needed
    ];

    const products = [
        { id: 101, name: 'Product A' },
        { id: 102, name: 'Product B' },
        // Add more products as needed
    ];

    return <SplitwiseContainer users={users} products={products} />;
};

export default App;
