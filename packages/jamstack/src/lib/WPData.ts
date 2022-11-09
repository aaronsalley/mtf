const API_URL =
  process.env.SENTRY_ENVIRONMENT !== 'development'
    ? typeof window !== 'undefined'
      ? process.env.NEXT_PUBLIC_API_URL
      : process.env.API_URL
    : typeof window !== 'undefined'
    ? 'http://aarons-macbook-pro.local:32769'
    : 'http://cms';

// metaKeywords,
// focuskw,
// canonical,
// cornerstone,
// opengraphPublishedTime,
// opengraphAuthor,
const SEO = `seo {
  title,
  metaDesc,
  metaRobotsNofollow,
  metaRobotsNoindex,
  readingTime,
  opengraphType,
  opengraphTitle,
  opengraphDescription,
  opengraphUrl,
  opengraphSiteName,
  opengraphModifiedTime,
  opengraphImage {
    mediaItemUrl,
    mediaDetails {
      width,
      height
    },
    mimeType,
  },
  opengraphPublisher,
  twitterTitle,
  twitterDescription,
  twitterImage {
    mediaItemUrl,
  },
  schema {
    raw
  }
}`;

const menuItems = `menuItems(where: {location: MEGA, parentId: ""}, first: 1000) {
  nodes {
    label,
    title,
    target,
    path,
    parentId,
    childItems {
      nodes {
        label,
        title,
        target,
        path,
        parentId,
      }
    }
  }
}`;
const navItems = `navItems: menuItems(where: {location: NAV, parentId: ""}, first: 1000) {
  nodes {
    label,
    title,
    target,
    path,
  }
}`;
const makers = `mediaItems(where: {mediaCategory: "maker"}, first: 50) {
  nodes {
    title,
    mediaType,
    mediaItemUrl,
    altText,
  }
}`;
const pages = `pages(where: {status: PUBLISH}, first: 100) {
  nodes {
    uri,
    title,
    content,
    excerpt,
    featuredImage {
      node {
        mediaType,
        mediaItemUrl,
        altText,
      }
    },
    contentTypeName,
    ${SEO},
  }
}`;
const events = `events(where: {status: PUBLISH}, first: 100) {
  nodes {
    id,
    title,
    excerpt,
    content,
    isAllDay,
    ticketPrice,
    datetimeEnd,
    datetimeStart,
    eventURL,
    eventCategories {
      nodes {
        name,
      },
    },
    tags {
      nodes {
        name,
      },
    },
    uri,
    slug,
    featuredImage {
      node {
        mediaType,
        mediaItemUrl,
        altText,
      }
    },
    ${SEO},
  },
},
seo {
  contentTypes {
    event {
      title,
      metaDesc,
      schemaType,
      schema {
        raw
      }
    }
  }
}`;
const posts = `posts(where: {status: PUBLISH}) {
  nodes {
    date,
    title,
    uri,
    content,
    excerpt,
    contentTypeName,
    ${SEO},
  }
},
seo {
  contentTypes {
    event {
      title,
      metaDesc,
      schemaType,
      schema {
        raw
      }
    }
  }
}`;
const site = `allSettings {
  siteName:generalSettingsTitle,
  metaDescription:generalSettingsDescription,
}`;

export const getLayoutData = async () => {
  try {
    const GraphQLQuery = {
      // operationName: 'getLayoutData',
      query: `query {
        ${site},
        ${menuItems},
        ${navItems},
      }`.replaceAll(/\s/gi, ''),
      variables: {},
    };

    const res = await fetch(API_URL + `/graphql`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(GraphQLQuery),
      // mode: 'no-cors',
    });

    const json = await res.json();
    if (json.errors) throw JSON.stringify(json.errors);

    const megaMenu = [];
    for (const item of json.data.menuItems.nodes) {
      if (!item.parentId) megaMenu.push(item);
    }
    json.data.menuItems.nodes = megaMenu;

    return json.data;
  } catch (error: any) {
    console.error('Fetch error: ', error.message);

    return {
      notFound: true,
    };
  }
};

export const getAll = async () => {
  try {
    const GraphQLQuery = {
      // operationName: 'getAll',
      query: `query {
        ${makers},
        ${pages},
        ${events},
        ${posts}
      }`.replaceAll(/\s/gi, ''),
      variables: {},
    };

    const res = await fetch(API_URL + `/graphql`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(GraphQLQuery),
      // mode: 'no-cors',
    });

    const json = await res.json();
    if (json.errors) throw JSON.stringify(json.errors);

    return json.data;
  } catch (error: any) {
    console.error('Fetch error: ', error.message);

    return {
      notFound: true,
    };
  }
};

export const getEvents = async () => {
  try {
    const GraphQLQuery = {
      // operationName: 'getAllContent',
      query: `query {
        ${events},
      }`.replaceAll(/\s/gi, ''),
      variables: {},
    };

    const res = await fetch(API_URL + `/graphql`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(GraphQLQuery),
      // mode: 'no-cors',
    });

    const json = await res.json();
    if (json.errors) throw JSON.stringify(json.errors);

    json.data['title'] = 'Work in progress';

    return json.data;
  } catch (error: any) {
    console.error('Fetch error: ', error.message);

    return {
      notFound: true,
    };
  }
};

export const getContent = async () => {
  try {
    const GraphQLQuery = {
      // operationName: 'getContent',
      query: `query {
        ${pages},
        ${posts},
      }`.replaceAll(/\s/gi, ''),
      variables: {},
    };

    const res = await fetch(API_URL + `/graphql`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(GraphQLQuery),
      // mode: 'no-cors',
    });

    const json = await res.json();
    if (json.errors) throw JSON.stringify(json.errors);

    return json.data;
  } catch (error: any) {
    console.error('Fetch error: ', error.message);

    return {
      notFound: true,
    };
  }
};

export const getPages = async () => {
  try {
    const GraphQLQuery = {
      // operationName: 'getContent',
      query: `query {
        ${pages},
      }`.replaceAll(/\s/gi, ''),
      variables: {},
    };

    const res = await fetch(API_URL + `/graphql`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(GraphQLQuery),
      // mode: 'no-cors',
    });

    const json = await res.json();
    if (json.errors) throw JSON.stringify(json.errors);

    return json.data;
  } catch (error: any) {
    console.error('Fetch error: ', error.message);

    return {
      notFound: true,
    };
  }
};

export const getPosts = async () => {
  try {
    const GraphQLQuery = {
      // operationName: 'getContent',
      query: `query {
        ${posts},
      }`.replaceAll(/\s/gi, ''),
      variables: {},
    };

    const res = await fetch(API_URL + `/graphql`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(GraphQLQuery),
      // mode: 'no-cors',
    });

    const json = await res.json();
    if (json.errors) throw JSON.stringify(json.errors);

    return json.data;
  } catch (error: any) {
    console.error('Fetch error: ', error.message);

    return {
      notFound: true,
    };
  }
};

export const getSingle = async (id: string | number) => {};
