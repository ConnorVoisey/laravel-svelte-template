import "./scalar.tsp";

namespace Models;

model User is Timestamps {
    @key
    @visibility("read")
    id: uuid;

    @format("email")
    email: string;

    name: string;

    @visibility("read")
    email_verified_at: utcDateTime | null;
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
    totalCount: uint32;
    offset: uint32;
    page: uint16;
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
model NotFoundError {
    message: "Not found";
}

@error
model ValidationError {
    message: string;
    errors: Record<string[]>;
}
