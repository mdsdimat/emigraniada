// UserList.tsx
import React from 'react';

interface UserListProps {
    users: { id: number; name: string }[];
}

const UserList: React.FC<UserListProps> = ({ users }) => {
    return (
        <div>
            <h2>User List</h2>
            <ul>
                {users.map(user => (
                    <li key={user.id}>{user.name}</li>
                ))}
            </ul>
        </div>
    );
};

export default UserList;
