const state = {
    filterData: {},
    showContractLoader: false,
    salesOrder: {
        id: (window.salesOrderId === null) ? null : window.salesOrderId,
        currentInsuranceId: null,
        newInsuranceId: null,
        fullName: null,
        address: null,
        householdType: null,
        numberOfFamilyMembers: null,
        newBorn: null,
        moveToSwitzerland: null,
        salesLeadSource: null,
        salesPersonId: null,
        signDate: null,
        salesOrderStatus: null,
        insuranceStatus: null,
        contractDurationVVG: 60,
        contractDurationKVG: 60,
        contractStartVVG: null,
        contractStartKVG: null,
        insuranceTrackingID: null,
        insuranceSubmittedDate: null,
        provisionDone: null,
        cancellationOriginal: null,
        cancellationStamped: null,
        taskCollectionId: null,
        contractPeople: []
    },
    contractPersonDetails: {
        firstName: null,
        lastName: null,
        gender: null,
        birthday: null,
        age: null,
        familyMemberType: null,
        policeNumber: null,
        selectedProduct: null,
        products: []
    },
    insurances: window.insurances !== undefined ? window.insurances : null,
    salesAgents: window.salesAgents !== undefined ? window.salesAgents : null,
    products: window.products !== undefined ? window.products : null,
    productCategories: window.productCategories !== undefined ? window.productCategories : null,
    users: window.users !== undefined ? window.users : null,
    tasksCollections: window.tasksCollections !== undefined ? window.tasksCollections : null,
    isAddingPersonViewOpen: false,
    dateFormat: "dd MM yyyy"
}

export default state;