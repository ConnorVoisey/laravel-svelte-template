import "./scalar.tsp";

namespace Models;
alias Role = "admin" | "user";
model User is Timestamps {
    @key
    @visibility("read")
    id: uuid;

    @format("email")
    email: string;

    name: string;

    @visibility("read")
    email_verified_at: utcDateTime | null;

    @visibility("create")
    @format("password")
    password: string;
    @visibility("create")
    @format("password")
    password_confirmation: string;

    role_name: Role | null
}

model Login {
    @format("email")
    email: string;

    password: password;
}

model Register {
    @format("email")
    email: string;

    password: password;
    password_configuration: password;
}

model Todo is Timestamps {
    @key
    @visibility("read")
    id: uuid;

    @maxLength(255)
    task: string;

    completed?: boolean = false;

    @visibility("read")
    user_id: uuid;
}

model Timestamps {
    @visibility("read")
    created_at: utcDateTime;

    @visibility("read")
    updated_at: utcDateTime;
}

model Paginated<Item> {
    data: Item[];
    count: uint32;
}

model Deleted {
    message: "Successfully deleted";
    deleted_count: uint32;
}

@error
model Error {
    message: string;
}

@error
model UnauthenticatedError {
    message: string;
}

@error
model UnauthorizedError {
    message: string;
}

@error
model NotFoundError {
    message: "Not found";
}

@error
model ValidationError {
    message: string;
    errors: Record<string[]>;
}
